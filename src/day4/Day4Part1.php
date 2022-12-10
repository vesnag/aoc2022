<?php

namespace AOC2022\day4;

final class Day4Part1
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

            $len1 = (int) $firstSection[1] - (int) $firstSection[0];
            $len2 = (int) $secondSection[1] - (int) $secondSection[0];

            if ($len1 === $len2) {
                if ($firstSection[0] === $secondSection[0]) {
                    $count++;
                }
                continue;
            }

            if ($len1 < $len2) {
                if ($firstSection[0] < $secondSection[0]) {
                    continue;
                }
                if ($firstSection[1] > $secondSection[1]) {
                    continue;
                }
                $count++;
                continue;
            }

            if ($firstSection[0] > $secondSection[0]) {
                continue;
            }

            if ($firstSection[1] < $secondSection[1]) {
                continue;
            }

            $count++;
        }

        return $count;
    }
}
