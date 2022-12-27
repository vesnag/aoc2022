<?php

namespace AOC2022\day4;

final class Day4Part2
{
    public static function countOverlappedAssignments(string $filename): int
    {
        $inputFileHandle = fopen('input/day4/' . $filename, 'r');
        if (!$inputFileHandle) {
            return 0;
        }

        $count = 0;
        while (($line = fgets($inputFileHandle)) !== false) {
            $sections = explode(',', $line);
            $firstSection = explode('-', $sections[0]);
            $secondSection = explode('-', $sections[1]);

            if (self::isOverlap($firstSection, $secondSection)) {
                $count++;
            }
        }

        fclose($inputFileHandle);

        return $count;
    }

  /**
   * @param array<int,string> $firstSection
   * @param array<int,string> $secondSection
   */
  private static function isOverlap(array $firstSection, array $secondSection): bool
  {
      return !($secondSection[1] < $firstSection[0] || $secondSection[0] > $firstSection[1]);
  }
}
