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
            $sections = explode(',', $line);
            $firstSection = explode('-', $sections[0]);
            $secondSection = explode('-', $sections[1]);

            if ($this->isFullyOverlap($firstSection, $secondSection)) {
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
  private function isFullyOverlap(array $firstSection, array $secondSection): bool
  {
      $len1 = (int) $firstSection[1] - (int) $firstSection[0];
      $len2 = (int) $secondSection[1] - (int) $secondSection[0];

      if ($len1 === $len2 && $firstSection[0] === $secondSection[0]) {
          return true;
      }

      // Check if the first section is fully contained within the second section.
      if ($firstSection[0] >= $secondSection[0] && $firstSection[1] <= $secondSection[1]) {
          return true;
      }

      // Check if the second section is fully contained within the first section.
      if ($secondSection[0] >= $firstSection[0] && $secondSection[1] <= $firstSection[1]) {
          return true;
      }

      return false;
  }
}
