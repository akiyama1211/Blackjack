<?php

namespace Blackjack;

require_once(__DIR__ . '/Deck.php');
require_once(__DIR__ . '/Player.php');

class Dealer extends Player
{
    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function firstDrawCards(Deck $deck): void
    {
        $this->drawCards($deck, 2);
        echo 'ディーラーの引いたカードは' . $this->hand[0] . 'です。' . PHP_EOL;
        echo 'ディーラーの引いた２枚目のカードは分かりません' . PHP_EOL;
    }

    public function secondDrawCards(Deck $deck, ScoreCounter $scoreCounter): void
    {
        echo 'ディーラーの引いた２枚目のカードは' . $this->hand[1] . 'でした' . PHP_EOL;

        $this->setScore($scoreCounter);

        $drawCount = 3;

        while ($this->score < 17) {
            echo 'ディーラーの現在の得点は' . $this->score . 'です。' . PHP_EOL;
            $this->drawCards($deck, 1);
            echo 'ディーラーの引いた' . mb_convert_kana((string)$drawCount, "N") . '枚目のカードは' . end($this->hand) . 'です' . PHP_EOL;
            $this->setScore($scoreCounter);
            $drawCount++;
        }
    }

    public function informScore(): void
    {
        echo 'ディーラーの得点は' . $this->score . 'です。' . PHP_EOL;
    }
}
