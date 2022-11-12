<?php

namespace Blackjack;

require_once(__DIR__ . '/Deck.php');
require_once(__DIR__ . '/Player.php');

class Cpu extends Player
{
    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function firstDrawCards(Deck $deck): void
    {
        $name = $this->getName();

        $this->drawCards($deck, 2);
        echo $name . 'の引いたカードは' . $this->hand[0] . 'です。' . PHP_EOL;
        echo $name . 'の引いたカードは' . $this->hand[1] . 'です。' . PHP_EOL;
    }

    public function secondDrawCards(Deck $deck, ScoreCounter $scoreCounter): void
    {
        $this->setScore($scoreCounter);

        $drawCount = 3;
        $name = $this->getName();

        while ($this->score < 17) {
            echo $name . 'の現在の得点は' . $this->score . 'です。' . PHP_EOL;
            $this->drawCards($deck, 1);
            echo $name . 'の引いた' . mb_convert_kana((string)$drawCount, "N") . '枚目のカードは' . end($this->hand) . 'です' . PHP_EOL;
            $this->setScore($scoreCounter);
            $drawCount++;
        }
    }

    public function informScore(): void
    {
        echo $this->getName() . 'の得点は' . $this->score . 'です。' . PHP_EOL;
    }
}
