<?php

// Define constants for Fizz, Buzz, and FizzBuzz
const FIZZ = "Fizz";
const BUZZ = "Buzz";
const FIZZBUZZ = "FizzBuzz";

/**
 * Generates an array of FizzBuzz results up to a given number.
 *
 * @param int $n The upper limit of the FizzBuzz sequence.
 * @return array The FizzBuzz sequence as an array of strings.
 */
function fizzBuzz(int $n): array {
    $result = [];

    for ($i = 1; $i <= $n; $i++) {
        if ($i % 3 === 0 && $i % 5 === 0) {
            $result[] = FIZZBUZZ;
        } elseif ($i % 3 === 0) {
            $result[] = FIZZ;
        } elseif ($i % 5 === 0) {
            $result[] = BUZZ;
        } else {
            $result[] = (string)$i;
        }
    }

    return $result;
}

// Example usage
$n = 15;
$output = fizzBuzz($n);
print_r($output);
