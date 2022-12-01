<?php

namespace AOC2022\day1;

final class Day1Part1
{

   /**
   * @param array<int,mixed> $data
   */
    public static function getMaxTotalCalories(array $data): int
    {
        $maxSum = 0;
        $currentSum = 0;

        foreach ($data as $item) {
          if (!is_numeric($item)) {
            if ($currentSum > $maxSum) {
              $maxSum = $currentSum;
            }
            $currentSum = 0;
            continue;
          }
          $currentSum += (int) $item;
        }

        return $maxSum;
    }

}
