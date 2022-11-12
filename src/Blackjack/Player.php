<?php

namespace Blackjack;

require_once(__DIR__ . '/Deck.php');

abstract class Player
{
    protected array $hand = [];
    protected int $score;

    public function __construct(protected string $name)
    {
    }

    abstract public function firstDrawCards(Deck $deck): void;
    abstract public function secondDrawCards(Deck $deck, ScoreCounter $scoreCounter): void;
    abstract public function informScore(): void;

    public function getName(): string
    {
        return $this->name;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function drawCards(Deck $deck, int $drawNum): void
    {
        $drawCards = array_slice($deck->getDeck(), 0, $drawNum);
        $this->hand = array_merge($this->hand, $drawCards);
        $deck->setDeck($drawNum);
    }

    public function setScore(ScoreCounter $scoreCounter): void
    {
        $this->score = $scoreCounter->convertToScore($this->hand);
    }

    //テスト用
    public function handleScore(int $score): void
    {
        $this->score = $score;
    }
}
