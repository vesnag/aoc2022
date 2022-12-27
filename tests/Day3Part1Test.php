<?php

declare(strict_types=1);

use AOC2022\day3\Day3Part1;
use PHPUnit\Framework\TestCase;

final class Day3Part1Test extends TestCase
{
    public function testSumOfPriorities(): void
    {
        $this->assertEquals(
            157,
            (new Day3Part1)->getSumOfPriorities('test-input.txt')
        );

        $this->assertEquals(
            8349,
            (new Day3Part1)->getSumOfPriorities('input.txt')
        );
    }
}
