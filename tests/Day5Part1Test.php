<?php

declare(strict_types=1);

use AOC2022\day5\Day5Part1;
use PHPUnit\Framework\TestCase;

final class Day5Part1Test extends TestCase
{
    public function testFindTopCrate(): void
    {
        $this->assertEquals(
            'CMZ',
            (new Day5Part1())->findTopCratesAfterRearrangement('test-input.txt')
        );

        $this->assertEquals(
            'WSFTMRHPP',
            (new Day5Part1())->findTopCratesAfterRearrangement('input.txt')
        );
    }
}
