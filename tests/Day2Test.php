<?php

declare(strict_types=1);

use AOC2022\day2\Day2;
use PHPUnit\Framework\TestCase;

final class Day2Test extends TestCase
{
    public function testTotalScorePart2(): void
    {
        $this->assertEquals(
          15,
          (new Day2())->getTotalScore('test-input.txt')
        );

        $this->assertEquals(
          16,
          (new Day2())->getTotalScore('test-input2.txt')
        );

        $this->assertEquals(
          8,
          (new Day2())->getTotalScore('test-input3.txt')
        );

        $this->assertEquals(
          12156,
          (new Day2())->getTotalScore('input.txt')
        );

        $this->assertEquals(
            12,
            (new Day2())->getTotalScore('test-input.txt', TRUE)
        );

        $this->assertEquals(
            10835,
            (new Day2())->getTotalScore('input.txt', TRUE)
        );
    }
}
