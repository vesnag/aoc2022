<?php

namespace AOC2022\day4;

final class Day4Part1
{
    public function countOverlappedAssignments(string $filename): int
    {
        $inputFileHandle = fopen('input/day4/' . $filename, 'r');
        if (!$inputFileHandle) {
            return 0;
        }

        $count = 0;
        while (($line = fgets($inputFileHandle)) !== false) {
            preg_match('/^([0-9]+)-([0-9]+),([0-9]+)-([0-9]+)$/', $line, $matches);
            $firstSection = [$matches[1], $matches[2]];
            $secondSection = [$matches[3], $matches[4]];

            if (self::areAssignmentsFullyOverlapped($firstSection, $secondSection)) {
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
  private static function areAssignmentsFullyOverlapped(array $firstSection, array $secondSection): bool
  {
      if (self::areSectionsEqualLengthAndStartPoint($firstSection, $secondSection)) {
          return true;
      }

      if (self::isSectionFullyContainedWithinOtherSection($firstSection, $secondSection)) {
          return true;
      }

      if (self::isSectionFullyContainedWithinOtherSection($secondSection, $firstSection)) {
          return true;
      }

      return false;
  }

  /**
   * @param array<int,string> $firstSection
   * @param array<int,string> $secondSection
   */
  private static function areSectionsEqualLengthAndStartPoint(array $firstSection, array $secondSection): bool
  {
      $len1 = (int) $firstSection[1] - (int) $firstSection[0];
      $len2 = (int) $secondSection[1] - (int) $secondSection[0];

      return $len1 === $len2 && $firstSection[0] === $secondSection[0];
  }

  /**
   * @param array<int,string> $innerSection The inner section.
   * @param array<int,string> $outerSection The outer section.
   */
  private static function isSectionFullyContainedWithinOtherSection(array $innerSection, array $outerSection): bool
  {
      return $innerSection[0] >= $outerSection[0] && $innerSection[1] <= $outerSection[1];
  }
}
