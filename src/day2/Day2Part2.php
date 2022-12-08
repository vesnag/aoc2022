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
            $shapeDecision1 = $this->getShape(trim($roundDecisions[0]));
            $roundDecisions2 = trim($roundDecisions[1]);
            $shapeDecision2 = $this->getShapeDecisionForRoundOutcome($roundDecisions2, $shapeDecision1);
            $roundOutcome = $roundDecisions2;

            $score += $this->getRoundScores($shapeDecision2, $roundOutcome);
        }

        return $score;
    }

    private function getShapeDecisionForRoundOutcome(string $outcome, string $shapeDecision1): string
    {
        if (self::OUTCOME_DRAW === $outcome) {
            return $shapeDecision1;
        }

        if (self::OUTCOME_LOSS === $outcome) {
            return $this->getShapeToLoosRound($shapeDecision1);
        }

        return $this->getShapeToWinRound($shapeDecision1);
    }

  /**
   * @return string SHAPE_*
   */
    private function getShapeToLoosRound(string $shapeDecision1): string
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
    private function getShapeToWinRound(string $shapeDecision1): string
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

    private function getRoundScores(string $shape2, string $roundOutcome): int
    {
        $shape2Score = $this->getShapeScore($shape2);
        $outcomeScore = $this->getOutcomeScores($roundOutcome);

        return $shape2Score + $outcomeScore;
    }

    private function getOutcomeScores(string $outcome): int
    {
        if (self::OUTCOME_WIN === $outcome) {
            return 6;
        }
        if (self::OUTCOME_LOSS === $outcome) {
            return 0;
        }

        return 3;
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
        if ('A' === $shape) {
            return self::SHAPE_ROCK;
        }
        if ('B' === $shape) {
            return self::SHAPE_PAPER;
        }
        if ('C' === $shape) {
            return self::SHAPE_SCISSORS;
        }
        if ('X' === $shape) {
            return self::SHAPE_ROCK;
        }
        if ('Y' === $shape) {
            return self::SHAPE_PAPER;
        }
        if ('Z' === $shape) {
            return self::SHAPE_SCISSORS;
        }

        return '';
    }
}
