<?php

declare(strict_types=1);

namespace Tests\Email;

use PHPUnit\Framework\MockObject\Exception as MockException;
use PHPMailer\PHPMailer\{PHPMailer, Exception as MailException};
use PHPUnit\Framework\TestCase;
use App\Email\EmailService;
use ReflectionClass;

final class EmailServiceTest extends TestCase
{
	/**
	 * @throws MockException
	 */
	public function testSendWelcomeEmail()
	{
		$emailService = new EmailService();

		$mailerMock = $this->createMock(PHPMailer::class);
		$mailerMock->expects($this->once())
			->method('send')
			->willReturn(true);

		// Simulate setting PHPMailer properties
		$emailServiceReflection = new ReflectionClass(EmailService::class);
		$mailerProperty = $emailServiceReflection->getProperty('mailer');
		$mailerProperty->setValue($emailService, $mailerMock);

		try {
			$emailService->sendWelcomeEmail('test@example.com', 'Test User');
		} catch (MailException $e) {
			$this->fail('Exception should not be thrown. Mail could not be sent.');
		}
	}
}
