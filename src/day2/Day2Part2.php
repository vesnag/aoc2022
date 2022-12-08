<?php

namespace AOC2022\day2;

final class Day2Part2
{
    public function getTotalScore(string $filename): int
    {
        $handle = fopen('input/day2/' . $filename, 'r');
        if (!$handle) {
            return 0;
        }

        $score = 0;
        while (($line = fgets($handle)) !== false) {
            $roundDecisions = explode(' ', $line);
            $decision1Score = self::getDecisionScore(trim($roundDecisions[0]));
            $roundScore = self::getRoundScores(trim($roundDecisions[1]));
            $decision2Score = self::getDecision2Score($roundScore, $decision1Score);
            $score += $decision2Score + $roundScore;
        }

        return $score;
    }

    private function getRoundScores(string $outcome): int
    {
        if ('X' === $outcome) {
            return 0;
        }
        if ('Y' === $outcome) {
            return 3;
        }
        if ('Z' === $outcome) {
            return 6;
        }

        return 0;
    }

    private function getDecision2Score(int $roundScore, int $decision1Score): int
    {
        if (3 === $roundScore) {
            return $decision1Score;
        }
        if (6 === $roundScore) {
            return self::getDecisionToWin($decision1Score);
        }
        if (0 === $roundScore) {
            return self::getDecisionToLose($decision1Score);
        }

        return 0;
    }

    private static function getDecisionToWin(int $decision1Score): int
    {
        if (1 === $decision1Score) {
            return 2;
        }
        if (2 === $decision1Score) {
            return 3;
        }
        if (3 === $decision1Score) {
            return 1;
        }

        return 0;
    }

    private static function getDecisionToLose(int $decision1Score): int
    {
        if (1 === $decision1Score) {
            return 3;
        }
        if (2 === $decision1Score) {
            return 1;
        }
        if (3 === $decision1Score) {
            return 2;
        }

        return 0;
    }

    private static function getDecisionScore(string $decision): int
    {
        if ('A' === $decision) {
            return 1;
        }
        if ('B' === $decision) {
            return 2;
        }
        if ('C' === $decision) {
            return 3;
        }

        return 0;
    }
}
