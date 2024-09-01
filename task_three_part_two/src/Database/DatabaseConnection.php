<?php

/*
 * The DatabaseConnection class manages the connection to the database.
 *
 * Responsibilities:
 * - Establish a connection to the database using PDO.
 * - Provide the established PDO connection for use in other classes.
 *
 * Dependencies:
 * - PDO: PHP Data Objects for database access.
 *
 * Methods:
 * - __construct: Initializes the database connection using environment variables.
 * - getConnection: Returns the established PDO connection.
 */

declare(strict_types=1);

namespace App\Database;

use PDOException;
use PDO;

final class DatabaseConnection
{
	private PDO $connection;

	/**
	 * @throws PDOException
	 */
	public function __construct()
	{
		$dsn = 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME');
		$username = getenv('DB_USERNAME');
		$password = getenv('DB_PASSWORD');

		try {
			$this->connection = new PDO($dsn, $username, $password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			// Handle connection error
			die('Database connection failed: ' . $e->getMessage());
		}
	}

	/**
	 * @return PDO
	 */
	public function getConnection(): PDO
	{
		return $this->connection;
	}
}
