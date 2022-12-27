<?php

namespace AOC2022\day5;

final class Day5Part1
{
    public function findTopCratesAfterRearrangement(string $filename): string
    {
        $inputFileHandle = fopen('input/day5/' . $filename, 'r');
        if (!$inputFileHandle) {
            return '';
        }

        $skipLine = false;
        $stack = [];
        $topCrates = [];
        $mode = 'filling';
        while (($line = fgets($inputFileHandle)) !== false) {
            if (true === $skipLine) {
                $skipLine = false;
                continue;
            }

            if ('rearranging' === $mode) {
                $this->rearrangeStackAndGetTopCrates($line, $stack, $topCrates);
                continue;
            }

            $isStackFilled = self::fillStack($line, $stack);
            if (true === $isStackFilled) {
                $mode = 'rearranging';
                $skipLine = true;
            }
        }

        fclose($inputFileHandle);

        ksort($topCrates, SORT_NUMERIC);

        return implode($topCrates);
    }

    /**
     * @param array<int, array<int, string>> $stack
     * @param array<int, mixed> $stackTopCrates
     */
    private function rearrangeStackAndGetTopCrates(string $line, array &$stack, array &$stackTopCrates): void
    {
        $numbers = self::getNumbersFromString($line);
        list($numberOfMoves, $from, $to) = $numbers;

        for ($i = 0; $i < $numberOfMoves; $i++) {
            $fromIndex = $from - 1;
            $toIndex = $to - 1;
            $crate = $stack[$fromIndex][0];

            array_shift($stack[$fromIndex]);
            $stack[$toIndex] = [$crate, ...$stack[$toIndex]];

            if ($numberOfMoves - 1 === $i) {
                $stackTopCrates[$toIndex] = $crate;
                $stackTopCrates[$fromIndex] = $stack[$fromIndex][0] ?? '';
            }
        }
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
        $matches = [];
        preg_match_all('/\d+/', $string, $matches);

        return $matches[0];
    }
}
