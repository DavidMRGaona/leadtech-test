<?php

function longestConsecutive(array $nums): int {
    // Check if the array is empty and return 0 if it is
    if (empty($nums)) {
        return 0;
    }

    // Convert the array to a set (using array_flip) to remove duplicates and allow fast lookups
    $numSet = array_flip($nums);
    $longestStreak = 0;

    // Iterate through each number in the array
    foreach ($nums as $num) {
        // Check if the number is the start of a sequence (no predecessor in the set)
        if (!isset($numSet[$num - 1])) {
            $currentNum = $num;
            $currentStreak = 1;

            // Use a while loop to count the length of the current sequence
            while (isset($numSet[$currentNum + 1])) {
                $currentNum++;
                $currentStreak++;
            }

            // Update the longest streak if the current sequence is longer
            $longestStreak = max($longestStreak, $currentStreak);
        }
    }

    return $longestStreak;
}
