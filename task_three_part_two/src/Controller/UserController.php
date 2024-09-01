<?php

/*
 * The UserController class handles user registration and notification.
 *
 * Responsibilities:
 * - Check if a user already exists in the database.
 * - Insert a new user into the database if they do not exist.
 * - Send a welcome email to the newly registered user.
 *
 * Dependencies:
 * - DatabaseConnection: Manages the connection to the database.
 * - EmailService: Handles sending emails.
 *
 * Methods:
 * - checkIfUserExists: Checks if a user exists in the database by email.
 * - insertUser: Inserts a new user into the database.
 * - sendWelcomeEmail: Sends a welcome email to the user.
 * - registerAndNotify: Registers the user and sends a welcome email if the user does not already exist.
 */

declare(strict_types=1);

namespace App\Controller;

use PHPMailer\PHPMailer\Exception as MailException;
use App\Database\DatabaseConnection;
use App\Email\EmailService;
use App\Request\Request;
use Exception;
use PDO;

final class UserController
{
	private PDO $connection;
	private EmailService $emailService;

	/**
	 * @param DatabaseConnection $dbConnection
	 * @param EmailService       $emailService
	 */
	public function __construct(DatabaseConnection $dbConnection, EmailService $emailService)
	{
		$this->connection = $dbConnection->getConnection();
		$this->emailService = $emailService;
	}

	/**
	 * @param string $email
	 * @return int|null
	 */
	private function checkIfUserExists(string $email): ?int
	{
		$stmt = $this->connection->prepare("SELECT id FROM users WHERE email = :email");
		$stmt->bindParam(':email', $email, PDO::PARAM_STR); // PDO::PARAM_STR is the default, but let's be explicit
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		return $user ? (int)$user['id'] : null;
	}

	/**
	 * @param string $name
	 * @param string $email
	 * @return int
	 */
	private function insertUser(string $name, string $email): int
	{
		$stmt = $this->connection->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
		$stmt->bindParam(':name', $name, PDO::PARAM_STR); // PDO::PARAM_STR is the default, but let's be explicit
		$stmt->bindParam(':email', $email, PDO::PARAM_STR); // PDO::PARAM_STR is the default, but let's be explicit
		$stmt->execute();

		return (int)$this->connection->lastInsertId();
	}

	/**
	 * Sends a welcome email to the user through the EmailService
	 *
	 * @param string $email
	 * @param string $name
	 * @return void
	 * @throws MailException
	 */
	private function sendWelcomeEmail(string $email, string $name): void
	{
		try {
			$this->emailService->sendWelcomeEmail($email, $name);
		} catch (MailException $e) {
			throw new MailException('Email could not be sent. Mailer Error: ' . $e->getMessage());
		}
	}

	/**
	 * Registers the user (if it doesn't exist) and returns the database id
	 * @param Request $request
	 * @return int
	 * @throws Exception
	 */
	public function registerAndNotify(Request $request): int
	{
		$email = $request->get('email');
		$name = $request->get('name');

		$userId = $this->checkIfUserExists($email);

		if ($userId === null) {
			try {
				$userId = $this->insertUser($name, $email);
				$this->sendWelcomeEmail($email, $name);
			} catch (Exception $e) {
				throw new Exception('User could not be registered. Error: ' . $e->getMessage());
			}
		}

		return $userId;
	}
}
