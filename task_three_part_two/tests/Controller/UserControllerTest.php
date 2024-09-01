<?php

declare(strict_types=1);

namespace Tests\Controller;

use PHPUnit\Framework\MockObject\{MockObject, Exception as MockException};
use App\Database\DatabaseConnection;
use App\Controller\UserController;
use PHPUnit\Framework\TestCase;
use App\Email\EmailService;
use App\Request\Request;
use Exception;
use PDOStatement;
use PDO;

final class UserControllerTest extends TestCase
{
	private MockObject $dbConnectionMock;
	private MockObject $emailServiceMock;
	private MockObject $requestMock;
	private UserController $userController;

	/**
	 * @return void
	 * @throws MockException
	 */
	protected function setUp(): void
	{
		// In this case we can mock those three final classes because we're using DG\BypassFinals extension
		$this->dbConnectionMock = $this->createMock(DatabaseConnection::class);
		$this->emailServiceMock = $this->createMock(EmailService::class);
		$this->requestMock = $this->createMock(Request::class);

		$this->userController = new UserController($this->dbConnectionMock, $this->emailServiceMock);
	}

	/**
	 * @throws MockException
	 * @throws Exception
	 */
	public function testRegisterAndNotifyUserExists()
	{
		$this->requestMock->method('get')
			->willReturnMap([
				['email', 'test@example.com'],
			]);

		$pdoMock = $this->createMock(PDO::class);
		$stmtMock = $this->createMock(PDOStatement::class);

		$stmtMock->method('execute')->willReturn(true);
		$stmtMock->method('fetch')->willReturn(['id' => 1]);

		$pdoMock->method('prepare')->willReturn($stmtMock);
		$this->dbConnectionMock->method('getConnection')->willReturn($pdoMock);

		$userId = $this->userController->registerAndNotify($this->requestMock);

		$this->assertEquals(1, $userId);
	}

	/**
	 * @throws MockException
	 * @throws Exception
	 */
	public function testRegisterAndNotifyUserDoesNotExist()
	{
		$this->requestMock->method('get')
			->willReturnMap([
				['email', 'test@example.com'],
				['name', 'Test User'],
			]);

		$pdoMock = $this->createMock(PDO::class);
		$stmtMock = $this->createMock(PDOStatement::class);

		$stmtMock->method('execute')->willReturn(true);
		$stmtMock->method('fetch')->willReturn(false);
		$pdoMock->method('prepare')->willReturn($stmtMock);
		$pdoMock->method('lastInsertId')->willReturn(2);

		$this->dbConnectionMock->method('getConnection')->willReturn($pdoMock);

		$this->emailServiceMock->expects($this->once())
			->method('sendWelcomeEmail')
			->with('test@example.com', 'Test User');

		$userId = $this->userController->registerAndNotify($this->requestMock);

		$this->assertEquals(2, $userId);
	}
}
