<?php

namespace Blackjack;

require_once(__DIR__ . '/Deck.php');
require_once(__DIR__ . '/Player.php');

class MainCharacter extends Player
{
    private const MAX_SCORE = 21;

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function firstDrawCards(Deck $deck): void
    {
        $this->drawCards($deck, 2);
        echo 'あなたの引いたカードは' . $this->hand[0] . 'です。' . PHP_EOL;
        echo 'あなたの引いたカードは' . $this->hand[1] . 'です。' . PHP_EOL;
    }

    public function secondDrawCards(Deck $deck, ScoreCounter $scoreCounter): void
    {
        $this->setScore($scoreCounter);
        echo 'あなたの現在の得点は' . $this->score . 'です。カードを引きますか？（y/n）' . PHP_EOL;

        $input = trim(fgets(STDIN));
        while ($input === 'y') {
            if ($this->score <= self::MAX_SCORE) {
                $this->drawCards($deck, 1);
                echo 'あなたの引いたカードは' . end($this->hand) . 'です。' . PHP_EOL;

                $this->setScore($scoreCounter);
                echo 'あなたの現在の得点は' . $this->score . 'です。カードを引きますか？（y/n）' . PHP_EOL;
                $input = trim(fgets(STDIN));
            } else {
                echo 'あなたの得点は21を超えているため、これ以上カードを引けません。' . PHP_EOL;
                break;
            }
        }
    }

    public function informScore(): void
    {
        echo 'あなたの得点は' . $this->score . 'です。' . PHP_EOL;
    }
}
