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
            (new Day6Part1())->findPositionOfPacketMarker('test-input.txt')
        );

        $this->assertEquals(
            5,
            (new Day6Part1())->findPositionOfPacketMarker('test-input2.txt')
        );

        $this->assertEquals(
            6,
            (new Day6Part1())->findPositionOfPacketMarker('test-input3.txt')
        );

        $this->assertEquals(
            10,
            (new Day6Part1())->findPositionOfPacketMarker('test-input4.txt')
        );

        $this->assertEquals(
            11,
            (new Day6Part1())->findPositionOfPacketMarker('test-input5.txt')
        );

        $this->assertEquals(
            1702,
            (new Day6Part1())->findPositionOfPacketMarker('input.txt')
        );
    }
}
