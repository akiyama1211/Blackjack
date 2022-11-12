<?php

namespace Blackjack;

require_once(__DIR__ . '/Deck.php');
require_once(__DIR__ . '/MainCharacter.php');
require_once(__DIR__ . '/Dealer.php');
require_once(__DIR__ . '/Cpu.php');
require_once(__DIR__ . '/ScoreCounter.php');
require_once(__DIR__ . '/JudgeWin.php');

class BlackjackGame
{
    private array $players = [];
    public function start(): void
    {
        echo 'ブラックジャックを開始します。' . PHP_EOL;
        $deck = new Deck();

        echo '何人でプレイしますか' . PHP_EOL;
        $party = (int)trim(fgets(STDIN));
        $this->getParty($party);

        $scoreCounter = new ScoreCounter();

        foreach ($this->players as $player) {
            $player->firstDrawCards($deck);
        }

        foreach ($this->players as $player) {
            $player->secondDrawCards($deck, $scoreCounter);
        }

        foreach ($this->players as $player) {
            $player->informScore();
        }

        $judgeWin = new JudgeWin();
        $judgeWin->getWinner($this->players, $this->players[0]);

        echo 'ブラックジャックを終了します。' . PHP_EOL;
    }

    public function getParty(int $party): void
    {
        while ($party < 2 || 4 < $party) {
            echo '2から4の数値を入力してください' . PHP_EOL;
            $party = (int)trim(fgets(STDIN));
        }

        $player1 = new MainCharacter('あなた');
        $dealer = new Dealer('ディーラー');

        $this->players[] = $player1;

        if ($party === 3) {
            $cpu1 = new Cpu('cpu1');
            $this->players[] = $cpu1;
        } elseif ($party === 4) {
            $cpu1 = new Cpu('cpu1');
            $cpu2 = new Cpu('cpu2');
            array_push($this->players, $cpu1, $cpu2);
        }
        $this->players[] = $dealer;
    }
}
