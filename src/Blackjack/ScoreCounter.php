<?php

namespace Blackjack;

class ScoreCounter
{
    private const MAX_SCORE = 21;
    public const CARD_SCORE = [
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'J' => 10,
        'Q' => 10,
        'K' => 10,
        'A' => 11
    ];

    public function convertToScore(array $cards): int
    {
        $scores = array_map(fn($card) => self::CARD_SCORE[substr($card, 1)], $cards);

        if (in_array(11, $scores)) {
            return $this->calcAceScore($scores);
        }

        return array_sum($scores);
    }

    public function calcAceScore(array $scores): int
    {
        $aceNumber = array_count_values($scores)[11];

        $maxValue = array_sum($scores) - 11 * $aceNumber + 1 * ($aceNumber - 1) + 11 * 1;
        $minValue = array_sum($scores) - 11 * $aceNumber + 1 * ($aceNumber);
        if ($this->isQualification($maxValue)) {
            return $maxValue;
        }
        return $minValue;
    }

    public function isQualification(int $score): bool
    {
        return $score <= self::MAX_SCORE;
    }
}
