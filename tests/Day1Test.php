<?php

declare(strict_types=1);

use AOC2022\day1\Day1;
use PHPUnit\Framework\TestCase;

final class Day1Test extends TestCase
{
    public function testMaxTotalCalories(): void
    {
        $this->assertEquals(
            24000,
            Day1::getMaxTotalCalories('test-input.txt', 1)
        );

        $this->assertEquals(
            70698,
            Day1::getMaxTotalCalories('input.txt', 1)
        );

        $this->assertEquals(
            45000,
            Day1::getMaxTotalCalories('test-input.txt', 3)
        );


        $this->assertEquals(
            206643,
            Day1::getMaxTotalCalories('input.txt', 3)
        );

        $this->assertEquals(
            0,
            Day1::getMaxTotalCalories('input.txt', 0)
        );

    }
}
