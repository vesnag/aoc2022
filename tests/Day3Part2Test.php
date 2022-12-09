<?php

declare(strict_types=1);

use AOC2022\day3\Day3Part2;
use PHPUnit\Framework\TestCase;

final class Day3Part2Test extends TestCase
{
    public function testSumOfGroupBadges(): void
    {
        $this->assertEquals(
            70,
            Day3Part2::getSumOfGroupBadges('test-input.txt', 3)
        );

        $this->assertEquals(
            2681,
            Day3Part2::getSumOfGroupBadges('input.txt', 3)
        );
    }
}
