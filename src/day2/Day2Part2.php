<?php

namespace AOC2022\day2;

final class Day2Part2
{
    private const OUTCOME_SCORE_LOSE = 0;
    private const OUTCOME_SCORE_DRAW = 3;
    private const OUTCOME_SCORE_WIN = 6;

    private const SHAPE_SCORE_ROCK = 1;
    private const SHAPE_SCORE_PAPER = 2;
    private const SHAPE_SCORE_SCISSORS = 3;

    public function getTotalScore(string $filename): int
    {
        $inputFileHandle = fopen('input/day2/' . $filename, 'r');
        if (!$inputFileHandle) {
            return 0;
        }

        $score = 0;

        while (($line = fgets($inputFileHandle)) !== false) {
            $roundDecisions = explode(' ', $line);
            $decision1Score = self::getDecisionScore(trim($roundDecisions[0]));
            $roundScore = self::getOutcomeScore(trim($roundDecisions[1]));
            $decision2Score = self::getSecondDecisionScore($roundScore, $decision1Score);
            $score += $decision2Score + $roundScore;
        }

        fclose($inputFileHandle);

        return $score;
    }

    private function getSecondDecisionScore(int $roundScore, int $decision1Score): int
    {
        if (self::OUTCOME_SCORE_DRAW === $roundScore) {
            return $decision1Score;
        }

        return self::returnValueInRange(match ($roundScore) {
            self::OUTCOME_SCORE_WIN => $decision1Score + 1,
            self::OUTCOME_SCORE_LOSE => $decision1Score - 1,
            default => 0,
        }, self::SHAPE_SCORE_SCISSORS);
    }

    private static function returnValueInRange(int $value, int $maxValue): int
    {
        if ($value <= 0) {
            return $value + $maxValue;
        }
        if ($value > $maxValue) {
            return $value - $maxValue;
        }
        return $value;
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

    private function getOutcomeScore(string $outcome): int
    {
        return match ($outcome) {
            'X' => self::OUTCOME_SCORE_LOSE,
            'Y' => self::OUTCOME_SCORE_DRAW,
            'Z' => self::OUTCOME_SCORE_WIN,
            default => 0,
        };
    }
}
