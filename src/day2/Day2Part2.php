<?php

namespace AOC2022\day2;

final class Day2Part2
{
    private const SHAPE_ROCK = 'rock';
    private const SHAPE_PAPER = 'paper';
    private const SHAPE_SCISSORS = 'scissors';

    private const OUTCOME_WIN = 'Z';
    private const OUTCOME_DRAW = 'Y';
    private const OUTCOME_LOSS = 'X';

    public function getTotalScore(string $filename): int
    {
        $handle = fopen('input/day2/' . $filename, 'r');
        if (!$handle) {
            return 0;
        }

        $score = 0;
        while (($line = fgets($handle)) !== false) {
            $roundDecisions = explode(' ', $line);
            $shapeDecision1 = self::getShape(trim($roundDecisions[0]));
            $roundDecisions2 = trim($roundDecisions[1]);
            $shapeDecision2 = self::getShapeDecisionForRoundOutcome($roundDecisions2, $shapeDecision1);
            $roundOutcome = $roundDecisions2;

            $score += self::getRoundScores($shapeDecision2, $roundOutcome);
        }

        return $score;
    }

    private static function getShapeDecisionForRoundOutcome(string $outcome, string $shapeDecision1): string
    {
        if (self::OUTCOME_DRAW === $outcome) {
            return $shapeDecision1;
        }

        if (self::OUTCOME_LOSS === $outcome) {
            return self::getShapeToLoosRound($shapeDecision1);
        }

        return self::getShapeToWinRound($shapeDecision1);
    }

  /**
   * @return string SHAPE_*
   */
    private static function getShapeToLoosRound(string $shapeDecision1): string
    {
        if (self::SHAPE_ROCK === $shapeDecision1) {
            return self::SHAPE_SCISSORS;
        }
        if (self::SHAPE_PAPER === $shapeDecision1) {
            return self::SHAPE_ROCK;
        }
        if (self::SHAPE_SCISSORS === $shapeDecision1) {
            return self::SHAPE_PAPER;
        }

        return '';
    }

    /**
     * @return string SHAPE_*
     */
    private static function getShapeToWinRound(string $shapeDecision1): string
    {
        if (self::SHAPE_ROCK === $shapeDecision1) {
            return self::SHAPE_PAPER;
        }
        if (self::SHAPE_PAPER === $shapeDecision1) {
            return self::SHAPE_SCISSORS;
        }
        if (self::SHAPE_SCISSORS === $shapeDecision1) {
            return self::SHAPE_ROCK;
        }

        return '';
    }

    private static function getRoundScores(string $shape2, string $roundOutcome): int
    {
        $shape2Score = self::getShapeScore($shape2);
        $outcomeScore = self::getOutcomeScores($roundOutcome);

        return $shape2Score + $outcomeScore;
    }

    private static function getOutcomeScores(string $outcome): int
    {
        if (self::OUTCOME_WIN === $outcome) {
            return 6;
        }
        if (self::OUTCOME_LOSS === $outcome) {
            return 0;
        }

        return 3;
    }

    private static function getShapeScore(string $shape): int
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

    private static function getShape(string $shape): string
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
