<?php

declare(strict_types=1);

namespace Tests\Database;

use App\Database\DatabaseConnection;
use PHPUnit\Framework\TestCase;
use PDO;

final class DatabaseConnectionTest extends TestCase
{
	public function testConnectionIsInstanceOfPDO()
	{
		$dbConnection = new DatabaseConnection();
		$pdo = $dbConnection->getConnection();

		$this->assertInstanceOf(PDO::class, $pdo);
	}
}
