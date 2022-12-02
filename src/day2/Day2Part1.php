<?php

namespace AOC2022\day2;

final class Day2Part1
{
    private const SHAPE_ROCK = 'rock';
    private const SHAPE_PAPER = 'paper';
    private const SHAPE_SCISSORS = 'scissors';

    private const OUTCOME_WIN = 'win';
    private const OUTCOME_DRAW = 'draw';
    private const OUTCOME_LOSS = 'loss';

    public static function getTotalScore(string $filename): int
    {
        $handle = fopen('input/day2/' . $filename, 'r');
        if (!$handle) {
            return 0;
        }

        $score = 0;
        while (($line = fgets($handle)) !== false) {
            $shapeDecisions = explode(' ', $line);
            $shapeDecision1 = self::getShapeName()[trim($shapeDecisions[0])];
            $shapeDecision2 = self::getShapeName()[trim($shapeDecisions[1])];

            $score += self::getRoundScores($shapeDecision1, $shapeDecision2);
        }

        return $score;
    }

     private static function getRoundScores(string $shape1, string $shape2): int
     {
         $shape2Score = self::getShapeScores($shape2);
         $outcomeScore = self::getScoresOfOutcomeOfTheRound($shape1, $shape2);

         return $shape2Score + $outcomeScore;
     }

     private static function getScoresOfOutcomeOfTheRound(string $shape1, string $shape2): int
     {
         $outcome = self::getOutcome($shape1, $shape2);
         return self::getOutcomeScores($outcome);
     }

    private static function getOutcome(string $shape1, string $shape2): string
    {
        if ($shape1 === $shape2) {
            return self::OUTCOME_DRAW;
        }

        if (
            ($shape2 === self::SHAPE_ROCK && $shape1 === self::SHAPE_SCISSORS) ||
            ($shape2 === self::SHAPE_PAPER && $shape1 === self::SHAPE_ROCK) ||
            ($shape2 === self::SHAPE_SCISSORS && $shape1 === self::SHAPE_PAPER)
        ) {
            return self::OUTCOME_WIN;
        }

        return self::OUTCOME_LOSS;
    }

     private static function getShapeScores(string $shape): int
     {
         return self::shapeScores()[$shape];
     }

    /**
    * @return array<string,int>
    */
     private static function shapeScores(): array
     {
         return [
           self::SHAPE_ROCK => 1,
           self::SHAPE_PAPER => 2,
           self::SHAPE_SCISSORS => 3,
         ];
     }

    /**
    * @return array<string,string>
    */
     private static function getShapeName(): array
     {
         return [
           'A' => self::SHAPE_ROCK,
           'B' => self::SHAPE_PAPER,
           'C' => self::SHAPE_SCISSORS,
           'X' => self::SHAPE_ROCK,
           'Y' => self::SHAPE_PAPER,
           'Z' => self::SHAPE_SCISSORS,
         ];
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
}
