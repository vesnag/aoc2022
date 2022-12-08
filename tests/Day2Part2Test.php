<?php

declare(strict_types=1);

use AOC2022\day2\Day2Part2;
use PHPUnit\Framework\TestCase;

final class Day2Part2Test extends TestCase
{
    public function testTotalScorePart2(): void
    {

        $this->assertEquals(
            12,
            (new Day2Part2())->getTotalScore('test-input.txt')
        );

        $this->assertEquals(
            10835,
            (new Day2Part2())->getTotalScore('input.txt')
        );
    }
}
