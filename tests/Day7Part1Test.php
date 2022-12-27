<?php

declare(strict_types=1);

use AOC2022\day7\Day7Part1;
use PHPUnit\Framework\TestCase;

final class Day7Part1Test extends TestCase
{
    public function testFindTopCrate(): void
    {
        $this->assertEquals(
            95437,
            (new Day7Part1())->calculateSumOfTotalSizesBelowThreshold('test-input.txt')
        );

        $this->assertEquals(
            1749646,
            (new Day7Part1())->calculateSumOfTotalSizesBelowThreshold('input.txt')
        );
    }
}
