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
        $this->shapeScores = $this->shapeScores();
        $this->shapeNames = $this->shapeNames();
    }

    public function getTotalScore(string $filename): int
    {
        $handle = fopen('input/day2/' . $filename, 'r');
        if (!$handle) {
            return 0;
        }

        $score = 0;
        while (($line = fgets($handle)) !== false) {
            $shapeDecisions = explode(' ', $line);
            $shapeDecision1 = $this->shapeNames[trim($shapeDecisions[0])];
            $shapeDecision2 = $this->shapeNames[trim($shapeDecisions[1])];
            $score += $this->getRoundScores($shapeDecision1, $shapeDecision2);
        }

        return $score;
    }

    private function getRoundScores(string $shape1, string $shape2): int
    {
        $shape2Score = $this->shapeScores[$shape2];
        $outcomeScore = $this->getScoresOfOutcomeOfTheRound($shape1, $shape2);

        return $shape2Score + $outcomeScore;
    }

    private function getScoresOfOutcomeOfTheRound(string $shape1, string $shape2): int
    {
        $outcome = self::getRoundOutcome($shape1, $shape2);
        return self::getOutcomeScores($outcome);
    }

    private function getRoundOutcome(string $shape1, string $shape2): string
    {
        if ($shape1 === $shape2) {
            return self::OUTCOME_DRAW;
        }

        if ((in_array([$shape1, $shape2], array_map(fn (array $winCombination) => array_reverse($winCombination), self::getWinCombinations())))) {
            return self::OUTCOME_WIN;
        }

        return self::OUTCOME_LOSS;
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
    * @return array<string,string>
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
}
