<?php

namespace AOC2022\day6;

final class Day6Part1
{
    public function findPositionOfPacketMarker(string $filename): int
    {
        $inputFileHandle = fopen('input/day6/' . $filename, 'r');
        if (!$inputFileHandle) {
            return -1;
        }

        $packetMarkerSize = 4;
        $window = [];
        $charCountPacketMarker = [];
        $characterCount = 0;

        while (!feof($inputFileHandle)) {
            $character = fgetc($inputFileHandle);
            $window[$characterCount] = $character;
            if (!isset($charCountPacketMarker[$character])) {
                $charCountPacketMarker[$character] = 0;
            }
            $charCountPacketMarker[$character]++;
            $characterCount++;

            if ($characterCount < $packetMarkerSize) {
                continue;
            }

            if (!array_filter($charCountPacketMarker, fn ($count) => $count > 1)) {
                return $characterCount;
            }

            $removedChar = array_shift($window);
            $charCountPacketMarker[$removedChar]--;
        }

        return $characterCount;
    }
}
