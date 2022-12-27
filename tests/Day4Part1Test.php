<?php

declare(strict_types=1);

use AOC2022\day4\Day4Part1;
use PHPUnit\Framework\TestCase;

final class Day4Part1Test extends TestCase
{
    public function testCountOverlappedAssignments(): void
    {
        $this->assertEquals(
            2,
            (new Day4Part1)->countOverlappedAssignments('test-input.txt')
        );

        $this->assertEquals(
            540,
            (new Day4Part1)->countOverlappedAssignments('input.txt')
        );
    }
}
