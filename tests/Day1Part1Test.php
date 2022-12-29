<?php

declare(strict_types=1);

use AOC2022\day1\Day1Part1;
use PHPUnit\Framework\TestCase;

final class Day1Part1Test extends TestCase
{
    public function testMaxTotalCaloriesPart1(): void
    {
        $this->assertEquals(
            24000,
            (new Day1Part1())->calculateTotalCalories('test-input.txt')
        );

        $this->assertEquals(
            70698,
            (new Day1Part1())->calculateTotalCalories('input.txt')
        );
    }
}
