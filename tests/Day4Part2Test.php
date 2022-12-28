<?php

declare(strict_types=1);

use AOC2022\day4\Day4Part2;
use PHPUnit\Framework\TestCase;

final class Day4Part2Test extends TestCase
{
    public function testCountOverlappedAssignments(): void
    {
        $this->assertEquals(
            4,
            (new Day4Part2())->countOverlappedAssignments('test-input.txt')
        );

        $this->assertEquals(
            872,
            (new Day4Part2())->countOverlappedAssignments('input.txt')
        );
    }
}
