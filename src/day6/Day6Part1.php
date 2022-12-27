<?php

namespace AOC2022\day6;

final class Day6Part1
{
    public static function findPositionOfMarker(string $filename): int
    {
        $file = fopen('input/day6/' . $filename, 'r');
        if (!$file) {
            return -1;
        }

        $windowSize = 4;
        $window = [];
        $i = 0;

        while (!feof($file)) {
            $character = fgetc($file);
            $window[$i] = $character;
            $i++;

            if ($i < $windowSize) {
                continue;
            }

            if (count(array_unique($window)) === $windowSize) {
                return $i;
            }

            array_shift($window);
        }

        return $i;
    }
}
