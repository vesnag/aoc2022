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
            Day5Part1::findTopCrate('test-input.txt')
        );

        $this->assertEquals(
            'WSFTMRHPP',
            Day5Part1::findTopCrate('input.txt')
        );
    }
}
