<?php

declare(strict_types=1);

use AOC2022\day2\Day2Part1;
use PHPUnit\Framework\TestCase;

final class Day2Part1Test extends TestCase
{
    public function testTotalScorePart1(): void
    {
        $this->assertEquals(
            15,
            (new Day2Part1())->getTotalScore('test-input.txt')
        );

        $this->assertEquals(
            16,
            (new Day2Part1())->getTotalScore('test-input2.txt')
        );

        $this->assertEquals(
            8,
            (new Day2Part1())->getTotalScore('test-input3.txt')
        );

        $this->assertEquals(
            12156,
            (new Day2Part1())->getTotalScore('input.txt')
        );
    }
}
