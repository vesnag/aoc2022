<?php

namespace AOC2022\day5;

final class Day5Part1
{
    public static function findTopCrate(string $filename): string
    {
        $handle = fopen('input/day5/' . $filename, 'r');
        if (!$handle) {
            return '';
        }

        $skipLine = false;
        $stackFilled = false;
        $stack = [];
        $stackTopCrates = [];
        while (($line = fgets($handle)) !== false) {
            if ($skipLine) {
                $skipLine = false;
                continue;
            }

            if (true === $stackFilled) {
                $matches = [];
                preg_match_all('/\d+/', $line, $matches);
                $numbers = $matches[0];
                $numberOfMoves = $numbers[0];
                $from = $numbers[1];
                $to = $numbers[2];

                for ($i = 0; $i < $numberOfMoves; $i++) {
                    $fromIndex = $from - 1;
                    $toIndex = $to - 1;
                    $crate = $stack[$fromIndex][0];

                    array_shift($stack[$fromIndex]);
                    $stack[$toIndex] = [$crate, ...$stack[$toIndex]];

                    if ($i === $numberOfMoves - 1) {
                        $stackTopCrates[$toIndex] = $crate;
                        $topCrateOfStackFrom = $stack[$fromIndex][0] ?? '';
                        $stackTopCrates[$fromIndex] = $topCrateOfStackFrom;
                    }
                }
                continue;
            }

            $strlen = strlen($line);
            $i = 1;
            $stackIndex = 0;

            while ($i < $strlen) {
                $crate = $line[$i];

                if (is_numeric($crate)) {
                    $stackFilled = true;
                    $skipLine = true;
                    break;
                }

                if (ord($crate) !== 32) {
                    $stack[$stackIndex][] = $crate;

                    if (empty($stackTopCrates[$stackIndex])) {
                        $stackTopCrates[$stackIndex] = $crate;
                    }
                }

                $stackIndex++;
                $i = $i + 4;
            }
        }

        ksort($stackTopCrates, SORT_NUMERIC);

        return implode($stackTopCrates);
    }
}
