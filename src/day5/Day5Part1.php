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
                    $el = $stack[$fromIndex][0];

                    array_shift($stack[$fromIndex]);
                    $stack[$toIndex] = [$el, ...$stack[$toIndex]];
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
                }

                $stackIndex++;
                $i = $i + 4;
            }
        }

        return self::getTopElementsString($stack);
    }


  /**
   * @param array<int, array<int, string>> $array
   */
    private static function getTopElementsString(array $array): string
    {
        $topElements = '';
        ksort($array, SORT_NUMERIC);
        foreach ($array as $item) {
            $topElements .= $item[0];
        }

        return $topElements;
    }
}
