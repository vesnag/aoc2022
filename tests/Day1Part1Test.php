<?php

declare(strict_types=1);

use AOC2022\day1\Day1Part1;
use PHPUnit\Framework\TestCase;

final class Day1Part1Test extends TestCase {

  public function testMaxSum(): void {
    $this->assertEquals(
      24000,
      Day1Part1::getMaxTotalCalories($this->readInput('test-input.txt'))
    );

    $this->assertEquals(
      70698,
      Day1Part1::getMaxTotalCalories($this->readInput('input.txt'))
    );
  }

  /**
   * @return array<int,mixed>
   */
  private function readInput(string $filename): array
  {
    if ($fileContent = file_get_contents('input/day1/' . $filename)) {
      return explode("\n", $fileContent);
    }

    return [];
  }

}