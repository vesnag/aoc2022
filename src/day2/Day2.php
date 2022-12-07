<?php

namespace AOC2022\day2;

final class Day2
{
    private const SHAPE_ROCK = 'rock';
    private const SHAPE_PAPER = 'paper';
    private const SHAPE_SCISSORS = 'scissors';

    private const OUTCOME_WIN = 'Z';
    private const OUTCOME_DRAW = 'Y';
    private const OUTCOME_LOSS = 'X';

    /**
    * @var array<int, array<int, string>> $winningCombinations
    */
    private array $winningCombinations;

    /**
     * @var array<int, array<int, string>> $loosingCombinations
     */
    private array $loosingCombinations;

    /**
    * @var array<string,int>
    */
    private array $shapeScores;

    /**
     * @var array<string, string>
     */
    private array $shapeNames;

    public function __construct()
    {
        $this->winningCombinations = $this->getWinCombinations();
        $this->loosingCombinations = $this->getLossCombinations();
        $this->shapeScores = $this->shapeScores();
        $this->shapeNames = $this->shapeNames();
    }

    public function getTotalScore(string $filename, bool $decrypt = false): int
    {
        $handle = fopen('input/day2/' . $filename, 'r');
        if (!$handle) {
            return 0;
        }

        $score = 0;
        while (($line = fgets($handle)) !== false) {
            $roundDecisions = explode(' ', $line);
            $shapeDecision1 = $this->shapeNames[trim($roundDecisions[0])];
            $shapeDecision2 = $this->defineSecondDecision($shapeDecision1, trim($roundDecisions[1]), $decrypt);
            $score += $this->getRoundScores($shapeDecision1, $shapeDecision2);
        }

        return $score;
    }

    private function defineSecondDecision(string $decision1, string $decision2, bool $decrypt): string
    {
        if ($decrypt) {
            return $this->getShapeDecisionForRoundOutcome($decision2, $decision1);
        }
        return $this->shapeNames[$decision2];
    }

    private function getShapeDecisionForRoundOutcome(string $outcome, string $shapeDecision1): string
    {
        if (self::OUTCOME_DRAW === $outcome) {
            return $shapeDecision1;
        }

        if (self::OUTCOME_LOSS === $outcome) {
            return $this->getShapeForDecision($this->loosingCombinations, $shapeDecision1);
        }

        return $this->getShapeForDecision($this->winningCombinations, $shapeDecision1);
    }

    private function getRoundScores(string $shape1, string $shape2): int
    {
        $shape2Score = $this->shapeScores[$shape2];
        $outcomeScore = $this->getScoresOfOutcomeOfTheRound($shape1, $shape2);

        return $shape2Score + $outcomeScore;
    }

     private function getScoresOfOutcomeOfTheRound(string $shape1, string $shape2): int
     {
         $outcome = $this->getRoundOutcome($shape1, $shape2);
         return $this->getOutcomeScores($outcome);
     }

    private function getRoundOutcome(string $shape1, string $shape2): string
    {
        if ($shape1 === $shape2) {
            return self::OUTCOME_DRAW;
        }

        if ((in_array([$shape1, $shape2], $this->loosingCombinations))) {
            return self::OUTCOME_WIN;
        }

        return self::OUTCOME_LOSS;
    }

    /**
     * @param array<int, array<int, string>> $combinations
     */
    private function getShapeForDecision(array $combinations, string $decisions): string
    {
        foreach ($combinations as $combination) {
            if ($combination[1] === $decisions) {
                return $combination[0];
            }
        }
        return '';
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

    /**
     * @return array<string,int>
     */
    private function shapeScores(): array
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
    private function shapeNames(): array
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

    /**
     * @return array<int, array<int, string>>
     */
    private function getWinCombinations(): array
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
    private function getLossCombinations(): array
    {
        return array_map(fn (array $winCombination) => array_reverse($winCombination), $this->getWinCombinations());
    }
}
