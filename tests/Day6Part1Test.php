<?php

declare(strict_types=1);

use AOC2022\day6\Day6Part1;
use PHPUnit\Framework\TestCase;

final class Day6Part1Test extends TestCase
{
    public function testFindTopCrate(): void
    {
        $this->assertEquals(
            7,
            Day6Part1::findPositionOfMarker('test-input.txt')
        );

        $this->assertEquals(
            5,
            Day6Part1::findPositionOfMarker('test-input2.txt')
        );

        $this->assertEquals(
            6,
            Day6Part1::findPositionOfMarker('test-input3.txt')
        );

        $this->assertEquals(
            10,
            Day6Part1::findPositionOfMarker('test-input4.txt')
        );

        $this->assertEquals(
            11,
            Day6Part1::findPositionOfMarker('test-input5.txt')
        );

        $this->assertEquals(
            1702,
            Day6Part1::findPositionOfMarker('input.txt')
        );
    }
}
