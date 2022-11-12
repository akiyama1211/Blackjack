<?php

namespace Blackjack;

require_once(__DIR__ . '/Player.php');

class JudgeWin
{
    private const MAX_SCORE = 21;

    public function getWinner(array $players, MainCharacter $player1): void
    {
        $scores = [];
        foreach ($players as $player) {
                $scores[$player->getName()] = $player->getScore();
        }

        foreach ($scores as $name => $score) {
            if (!$this->isQualification($score)) {
                unset($scores[$name]);
            }
        }
        $winnerNumber = $this->countWinner($scores);

        if ($winnerNumber === 0) {
            echo '全員失格のため、引き分けです。' . PHP_EOL;
        } elseif ($winnerNumber === 1) {
            $winnerName = array_keys($scores, max($scores))[0];

            if ($player1->getName() === $winnerName) {
                echo $winnerName . 'の勝利です！' . PHP_EOL;
            } else {
                echo $winnerName . 'の勝利です。' . PHP_EOL;
                echo $player1->getName() . 'は負けました。' . PHP_EOL;
            }
        } else {
            echo '１位が複数人いるため、引き分けです。' . PHP_EOL;
        }
    }

    public function countWinner(array $scores): int
    {
        if (count($scores) === 0) {
            return 0;
        } else {
            return count(array_keys($scores, max($scores)));
        }
    }

    public function isQualification(int $score): bool
    {
        return $score <= self::MAX_SCORE;
    }
}
