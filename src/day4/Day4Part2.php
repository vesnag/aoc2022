<?php

namespace AOC2022\day4;

final class Day4Part2
{
    public static function countOverlappedAssignments(string $filename): int
    {
        $handle = fopen('input/day4/' . $filename, 'r');
        if (!$handle) {
            return 0;
        }

        $count = 0;
        while (($line = fgets($handle)) !== false) {
            $sections = explode(',', $line);
            $firstSection = explode('-', $sections[0]);
            $secondSection = explode('-', $sections[1]);

            if ($secondSection[1] < $firstSection[0]) {
                if ($secondSection[0] > $firstSection[1]) {
                    $count++;
                }
                continue;
            }

            if ($firstSection[1] >= $secondSection[0]) {
                $count++;
            }
        }

        return $count;
    }
}
