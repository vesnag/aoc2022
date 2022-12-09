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
            $shapeDecision1 = self::getShape(trim($shapeDecisions[0]));
            $shapeDecision2 = self::getShape(trim($shapeDecisions[1]));
            $score += self::getRoundScores($shapeDecision1, $shapeDecision2);
        }

        return $score;
    }

    private static function getRoundScores(string $shape1, string $shape2): int
    {
        $shape2Score = self::getShapeScore($shape2);
        $outcomeScore = self::getOutcomeScores($shape1, $shape2);

        return $shape2Score + $outcomeScore;
    }

    private static function getOutcomeScores(string $shape1, string $shape2): int
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

    private static function getShapeScore(string $shape): int
    {
        return match ($shape) {
            self::SHAPE_ROCK => 1,
            self::SHAPE_PAPER => 2,
            self::SHAPE_SCISSORS => 3,
            default => 0,
        };
    }

    private static function getShape(string $shape): string
    {
        return match ($shape) {
            'A', 'X' => self::SHAPE_ROCK,
            'B', 'Y' => self::SHAPE_PAPER,
            'C', 'Z' => self::SHAPE_SCISSORS,
            default => '',
        };
    }
}
