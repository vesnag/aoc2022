<?php

namespace AOC2022\day2;

final class Day2Part2
{
    private const OUTCOME_ROUND_SCORE_LOSE = 0;
    private const OUTCOME_ROUND_SCORE_DRAW = 3;
    private const OUTCOME_ROUND_SCORE_WIN = 6;

    private const SHAPE_SCORE_ROCK = 1;
    private const SHAPE_SCORE_PAPER = 2;
    private const SHAPE_SCORE_SCISSORS = 3;

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
            $decision2Score = self::getSecondDecisionScore($roundScore, $decision1Score);
            $score += $decision2Score + $roundScore;
        }

        return $score;
    }

    private function getRoundScores(string $outcome): int
    {
        return match ($outcome) {
            'X' => self::OUTCOME_ROUND_SCORE_LOSE,
            'Y' => self::OUTCOME_ROUND_SCORE_DRAW,
            'Z' => self::OUTCOME_ROUND_SCORE_WIN,
            default => 0,
        };
    }

    private function getSecondDecisionScore(int $roundScore, int $decision1Score): int
    {
        return match ($roundScore) {
            self::OUTCOME_ROUND_SCORE_DRAW => $decision1Score,
            self::OUTCOME_ROUND_SCORE_WIN => self::getDecisionScoreToWin($decision1Score),
            self::OUTCOME_ROUND_SCORE_LOSE => self::getDecisionScoreToLose($decision1Score),
            default => 0,
        };
    }

    private static function getDecisionScoreToWin(int $decision1Score): int
    {
        return match ($decision1Score) {
            self::SHAPE_SCORE_ROCK => self::SHAPE_SCORE_PAPER,
            self::SHAPE_SCORE_PAPER => self::SHAPE_SCORE_SCISSORS,
            self::SHAPE_SCORE_SCISSORS => self::SHAPE_SCORE_ROCK,
            default => 0,
        };
    }

    private static function getDecisionScoreToLose(int $decision1Score): int
    {
        return match ($decision1Score) {
            self::SHAPE_SCORE_ROCK => self::SHAPE_SCORE_SCISSORS,
            self::SHAPE_SCORE_PAPER => self::SHAPE_SCORE_ROCK,
            self::SHAPE_SCORE_SCISSORS => self::SHAPE_SCORE_PAPER,
            default => 0,
        };
    }

    private static function getDecisionScore(string $decision): int
    {
        return match ($decision) {
            'A' => self::SHAPE_SCORE_ROCK,
            'B' => self::SHAPE_SCORE_PAPER,
            'C' => self::SHAPE_SCORE_SCISSORS,
            default => 0,
        };
    }
}
