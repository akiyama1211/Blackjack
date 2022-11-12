<?php

namespace Blackjack;

class Deck
{
    private array $cards;
    public function __construct()
    {
        $numbers = range(2, 10);
        array_push($numbers, 'J', 'Q', 'K', 'A');

        foreach (['H', 'S', 'D', 'C'] as $suit) {
            foreach ($numbers as $number) {
                $this->cards[] = $suit . $number;
            }
        }
        shuffle($this->cards);
    }

    public function getDeck(): array
    {
        return $this->cards;
    }

    public function setDeck(int $num): void
    {
        $this->cards =  array_slice($this->cards, $num);
    }
}
