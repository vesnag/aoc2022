<?php

namespace AOC2022\day5;

final class Day5Part2
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
                self::rearrangeStackAndGetTopCrates($line, $stack);
                continue;
            }

            $stackFilled = self::fillStack($line, $stack);
            if ($stackFilled) {
                $skipLine = true;
            }
        }

        ksort($stack);
        return implode('', array_map(fn ($el) => $el[0], $stack));
    }

    /**
     * @param array<int, array<int, string>> $stack
     */
    private static function rearrangeStackAndGetTopCrates(string $line, array &$stack): void
    {
        $numbers = self::getNumbersFromString($line);
        list($numberOfMoves, $from, $to) = $numbers;
        $from--;
        $to--;
        $cratesToMove = array_slice($stack[$from], 0, $numberOfMoves);
        $stack[$to] = array_merge($cratesToMove, $stack[$to]);
        array_splice($stack[$from], 0, $numberOfMoves);
    }

    /**
     * @param array<int, array<int, string>> $stack
     */
    private static function fillStack(string $line, array &$stack): bool
    {
        $stackIndex = 0;
        for ($i = 1; isset($line[$i]); $i = $i+4) {
            $crate = $line[$i];
            if ($crate === PHP_EOL) {
                return false;
            }
            if (is_numeric($crate)) {
                return true;
            }

            if (ord($crate) === 32) {
                $stackIndex++;
                continue;
            }

            $stack[$stackIndex][] = $crate;

            if (empty($stackTopCrates[$stackIndex])) {
                $stackTopCrates[$stackIndex] = $crate;
            }

            $stackIndex++;
        }

        return false;
    }

    /**
    * @return array<int, int>
    */
    private static function getNumbersFromString(string $string): array
    {
        preg_match_all('/\d+/', $string, $matches);

        return $matches[0];
    }
}
