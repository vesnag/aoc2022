<?php

declare(strict_types=1);

use AOC2022\day1\Day1Part2;
use PHPUnit\Framework\TestCase;

final class Day1Part2Test extends TestCase
{
    public function testMaxTotalCalories(): void
    {
        $this->assertEquals(
            24000,
            (new Day1Part2())->calculateTotalCalories('test-input.txt', 1)
        );

        $this->assertEquals(
            70698,
            (new Day1Part2())->calculateTotalCalories('input.txt', 1)
        );

        $this->assertEquals(
            45000,
            (new Day1Part2())->calculateTotalCalories('test-input.txt', 3)
        );

        $this->assertEquals(
            206643,
            (new Day1Part2())->calculateTotalCalories('input.txt', 3)
        );

        $this->assertEquals(
            0,
            (new Day1Part2())->calculateTotalCalories('input.txt', 0)
        );
    }
}
