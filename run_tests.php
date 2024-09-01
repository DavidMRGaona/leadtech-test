<?php

require_once 'fizzBuzz.php';
require_once 'longestConsecutiveSequence.php';

function testFizzBuzz(): void
{
    $testCases = [
        [15, ["1", "2", FIZZ, "4", BUZZ, FIZZ, "7", "8", FIZZ, BUZZ, "11", FIZZ, "13", "14", FIZZBUZZ]],
        [1, ["1"]],
        [3, ["1", "2", FIZZ]],
        [5, ["1", "2", FIZZ, "4", BUZZ]],
        [0, []],
        [10, ["1", "2", FIZZ, "4", BUZZ, FIZZ, "7", "8", FIZZ, BUZZ]],
    ];

    foreach ($testCases as $index => $testCase) {
        [$input, $expected] = $testCase;
        $output = fizzBuzz($input);
        echo "FizzBuzz Test Case " . ($index + 1) . ": " .
            ($output === $expected ? "Passed" : "Failed") .
            " (Output: " . json_encode($output) . ", Expected: " . json_encode($expected) . ")\n";
    }
}

function testLongestConsecutive(): void
{
    $testCases = [
        [[100, 4, 200, 1, 3, 2], 4],
        [[0, -1, 1, 2, -2, -3], 6],
        [[10, 5, 12, 3, 55, 30, 31, 32, 33], 4],
        [[1, 2, 0, 1], 3],
        [[], 0],
        [[1], 1],
        [[1, 2, 2, 3, 4, 4, 5], 5],
    ];

    foreach ($testCases as $index => $testCase) {
        [$input, $expected] = $testCase;
        $output = longestConsecutive($input);
        echo "LongestConsecutive Test Case " . ($index + 1) . ": " .
            ($output === $expected ? "Passed" : "Failed") .
            " (Output: $output, Expected: $expected)\n";
    }
}

$testType = $argv[1] ?? '';

if ($testType === 'fizzBuzz') {
    testFizzBuzz();
} elseif ($testType === 'longestConsecutive') {
    testLongestConsecutive();
} else {
    echo "Please provide a valid test type: 'fizzBuzz' or 'longestConsecutive'.\n";
}
