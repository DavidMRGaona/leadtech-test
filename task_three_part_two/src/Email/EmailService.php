<?php

/*
 * The EmailService class handles sending emails using PHPMailer.
 *
 * Responsibilities:
 * - Configure PHPMailer settings.
 * - Send a welcome email to a newly registered user.
 *
 * Dependencies:
 * - PHPMailer: A full-featured email creation and transfer class for PHP.
 *
 * Methods:
 * - __construct: Configures PHPMailer settings.
 * - sendWelcomeEmail: Sends a welcome email to the user.
 */

declare(strict_types=1);

namespace App\Email;

use PHPMailer\PHPMailer\{PHPMailer, Exception as MailException};

final class EmailService
{
	private PHPMailer $mailer;

	public function __construct()
	{
		$this->mailer = new PHPMailer(true);

		// Server settings
		$this->mailer->isSMTP();
		$this->mailer->Host = getenv('SMTP_HOST');
		$this->mailer->SMTPAuth = true;
		$this->mailer->Username = getenv('SMTP_USERNAME');
		$this->mailer->Password = getenv('SMTP_PASSWORD');
		$this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$this->mailer->Port = getenv('SMTP_PORT');
	}

	/**
	 * @param string $email
	 * @param string $name
	 * @throws MailException
	 */
	public function sendWelcomeEmail(string $email, string $name): void
	{
		try {
			$this->mailer->setFrom(getenv('MAIL_FORM'), getenv('MAIL_NAME'));
			$this->mailer->addAddress($email);
			$this->mailer->isHTML(true); // true is default but let's be explicit
			$this->mailer->Subject = 'Welcome to Leadtech';
			$this->mailer->Body = "Hello $name, thanks for registering on our site. <br>Regards, Leadtech Team";

			$this->mailer->send();
		} catch (MailException $e) {
			// Send email error
			throw new MailException('Email could not be sent. Mailer Error: ' . $this->mailer->ErrorInfo);
		}
	}
}
