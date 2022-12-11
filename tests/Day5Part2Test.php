<?php

declare(strict_types=1);

use AOC2022\day5\Day5Part2;
use PHPUnit\Framework\TestCase;

final class Day5Part2Test extends TestCase
{
    public function testFindTopCrate(): void
    {
        $this->assertEquals(
            'MCD',
            Day5Part2::findTopCrate('test-input.txt')
        );

        $this->assertEquals(
            'GSLCMFBRP',
            Day5Part2::findTopCrate('input.txt')
        );
    }
}
