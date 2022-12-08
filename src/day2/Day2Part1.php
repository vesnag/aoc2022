<?php

namespace AOC2022\day2;

final class Day2Part1
{
    private const SHAPE_ROCK = 'rock';
    private const SHAPE_PAPER = 'paper';
    private const SHAPE_SCISSORS = 'scissors';

    public function getTotalScore(string $filename): int
    {
        $handle = fopen('input/day2/' . $filename, 'r');
        if (!$handle) {
            return 0;
        }

        $score = 0;
        while (($line = fgets($handle)) !== false) {
            $shapeDecisions = explode(' ', $line);
            $shapeDecision1 = $this->getShape(trim($shapeDecisions[0]));
            $shapeDecision2 = $this->getShape(trim($shapeDecisions[1]));
            $score += $this->getRoundScores($shapeDecision1, $shapeDecision2);
        }

        return $score;
    }

    private function getRoundScores(string $shape1, string $shape2): int
    {
        $shape2Score = $this->getShapeScore($shape2);
        $outcomeScore = self::getOutcomeScores($shape1, $shape2);

        return $shape2Score + $outcomeScore;
    }

    private function getOutcomeScores(string $shape1, string $shape2): int
    {
        if ($shape1 === $shape2) {
            return 3;
        }

        if (in_array([$shape1, $shape2], [
            [self::SHAPE_ROCK, self::SHAPE_SCISSORS],
            [self::SHAPE_PAPER, self::SHAPE_ROCK],
            [self::SHAPE_SCISSORS, self::SHAPE_PAPER],
        ])) {
            return 0;
        }

        return 6;
    }

    private function getShapeScore(string $shape): int
    {
        if (self::SHAPE_ROCK === $shape) {
            return 1;
        }
        if (self::SHAPE_PAPER === $shape) {
            return 2;
        }
        if (self::SHAPE_SCISSORS === $shape) {
            return 3;
        }

        return 0;
    }

    private function getShape(string $shape): string
    {
        if ('A' === $shape || 'X' === $shape) {
            return self::SHAPE_ROCK;
        }
        if ('B' === $shape || 'Y' === $shape) {
            return self::SHAPE_PAPER;
        }
        if ('C' === $shape || 'Z' === $shape) {
            return self::SHAPE_SCISSORS;
        }

        return '';
    }
}
