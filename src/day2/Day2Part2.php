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

    public static function getTotalScore(string $filename): int
    {
        $handle = fopen('input/day2/' . $filename, 'r');
        if (!$handle) {
            return 0;
        }

        $score = 0;
        while (($line = fgets($handle)) !== false) {
            $roundDecisions = explode(' ', $line);
            $shapeDecision1 = self::getShapeName()[trim($roundDecisions[0])];
            $shapeDecision2 = self::getShapeDecisionForRoundOutcome(trim($roundDecisions[1]), $shapeDecision1);
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
         $outcome = self::getRoundOutcome($shape1, $shape2);
         return self::getOutcomeScores($outcome);
     }

    private static function getRoundOutcome(string $shape1, string $shape2): string
    {
        if ($shape1 === $shape2) {
            return self::OUTCOME_DRAW;
        }

        if ((in_array([$shape1, $shape2], self::getLossCombinations()))) {
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
    * @return array<string, string>
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

    private static function getShapeDecisionForRoundOutcome(string $outcome, string $shapeDecision1): string
    {
        if (self::OUTCOME_DRAW === $outcome) {
            return $shapeDecision1;
        }

        if (self::OUTCOME_LOSS === $outcome) {
            $combinations = self::getLossCombinations();
            return self::getShapeForDecision($combinations, $shapeDecision1);
        }

        $combinations = self::getWinCombinations();
        return self::getShapeForDecision($combinations, $shapeDecision1);
    }

   /**
   * @return array<int, array<int, string>>
   */
    private static function getWinCombinations(): array
    {
        return [
            [self::SHAPE_ROCK, self::SHAPE_SCISSORS],
            [self::SHAPE_PAPER, self::SHAPE_ROCK],
            [self::SHAPE_SCISSORS, self::SHAPE_PAPER],
        ];
    }

   /**
   * @return array<int, array<int, string>>
   */
    private static function getLossCombinations(): array
    {
        return array_map(fn (array $winCombination) => array_reverse($winCombination), self::getWinCombinations());
    }

    /**
     * @param array<int, array<int, string>> $combinations
     */
    private static function getShapeForDecision(array $combinations, string $decisions): string
    {
        foreach ($combinations as $combination) {
            if ($combination[1] === $decisions) {
                return $combination[0];
            }
        }
        return '';
    }
}
