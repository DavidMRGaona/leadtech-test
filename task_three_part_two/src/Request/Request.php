<?php

/*
 * The Request class handles HTTP request data.
 *
 * Responsibilities:
 * - Retrieve data from the HTTP request.
 *
 * Methods:
 * - __construct: Initializes the request data.
 * - get: Retrieves a value from the request data by key.
 */

declare(strict_types=1);

namespace App\Request;

final class Request
{
	private array|null|false $data;

	/**
	 * Request constructor. Filters and sanitizes the post data
	 *
	 * @param array $postData
	 */
	public function __construct(array $postData)
	{
		$this->data = filter_var_array($postData, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}

	/**
	 * Returns the value of the key if it exists, otherwise returns null
	 *
	 * @param string $key
	 * @return mixed|null
	 */
	public function get(string $key): mixed
	{
		return $this->data[$key] ?? null;
	}
}
