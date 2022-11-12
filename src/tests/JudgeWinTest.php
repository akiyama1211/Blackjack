<?php

namespace Blackjack\Tests;

use PHPUnit\Framework\TestCase;
use Blackjack\JudgeWin;
use Blackjack\Dealer;
use Blackjack\MainCharacter;

use function PHPUnit\Framework\assertSame;

require_once(__DIR__ . '/../../lib/Blackjack/judgeWin.php');
require_once(__DIR__ . '/../../lib/Blackjack/MainCharacter.php');
require_once(__DIR__ . '/../../lib/Blackjack/Dealer.php');

class JudgeWinTest extends TestCase
{
    public function testGetWinner()
    {
        $players = [];
        $player1 = new MainCharacter('あなた');
        $dealer = new Dealer('ディーラー');
        array_push($players, $player1, $dealer);

        $judgeWin = new JudgeWin();

        $this->expectOutputString('全員失格のため、引き分けです。' . PHP_EOL);
        $player1->handleScore(26);
        $dealer->handleScore(22);
        $judgeWin->getWinner($players, $player1);
    }

    public function test2GetWinner()
    {
        $players = [];
        $player1 = new MainCharacter('あなた');
        $dealer = new Dealer('ディーラー');
        array_push($players, $player1, $dealer);

        $judgeWin = new JudgeWin();

        $this->expectOutputString('全員失格のため、引き分けです。' . PHP_EOL);
        $player1->handleScore(22);
        $dealer->handleScore(22);
        $judgeWin->getWinner($players, $player1);
    }

    public function test3GetWinner()
    {
        $players = [];
        $player1 = new MainCharacter('あなた');
        $dealer = new Dealer('ディーラー');
        array_push($players, $player1, $dealer);

        $judgeWin = new JudgeWin();
        $output = <<<EOD
        ディーラーの勝利です。
        あなたは負けました。

        EOD;

        $this->expectOutputString($output);
        $player1->handleScore(22);
        $dealer->handleScore(21);
        $judgeWin->getWinner($players, $player1);
    }

    public function test4GetWinner()
    {
        $players = [];
        $player1 = new MainCharacter('あなた');
        $dealer = new Dealer('ディーラー');
        array_push($players, $player1, $dealer);

        $judgeWin = new JudgeWin();
        $output = <<<EOD
        ディーラーの勝利です。
        あなたは負けました。

        EOD;

        $this->expectOutputString($output);
        $player1->handleScore(12);
        $dealer->handleScore(14);
        $judgeWin->getWinner($players, $player1);
    }

    public function test5GetWinner()
    {
        $players = [];
        $player1 = new MainCharacter('あなた');
        $dealer = new Dealer('ディーラー');
        array_push($players, $player1, $dealer);

        $judgeWin = new JudgeWin();

        $this->expectOutputString('１位が複数人いるため、引き分けです。' . PHP_EOL);
        $player1->handleScore(12);
        $dealer->handleScore(12);
        $judgeWin->getWinner($players, $player1);
    }

    public function test6GetWinner()
    {
        $players = [];
        $player1 = new MainCharacter('あなた');
        $dealer = new Dealer('ディーラー');
        array_push($players, $player1, $dealer);

        $judgeWin = new JudgeWin();

        $this->expectOutputString('あなたの勝利です！' . PHP_EOL);
        $player1->handleScore(14);
        $dealer->handleScore(22);
        $judgeWin->getWinner($players, $player1);
    }

    public function test7GetWinner()
    {
        $players = [];
        $player1 = new MainCharacter('あなた');
        $dealer = new Dealer('ディーラー');
        array_push($players, $player1, $dealer);

        $judgeWin = new JudgeWin();

        $this->expectOutputString('あなたの勝利です！' . PHP_EOL);
        $player1->handleScore(14);
        $dealer->handleScore(12);
        $judgeWin->getWinner($players, $player1);
    }

    public function testCountWinner()
    {
        $judgeWin = new JudgeWin();
        $scores = [21];
        assertSame(1, $judgeWin->countWinner($scores));
        $scores = [];
        assertSame(0, $judgeWin->countWinner($scores));
        $scores = [12 ,14];
        assertSame(1, $judgeWin->countWinner($scores));
        $scores = [12 ,12];
        assertSame(2, $judgeWin->countWinner($scores));
        // $scores = [22 ,22, 22];
        // assertSame(0, $judgeWin->countWinner($scores));
        // $scores = [12 ,22, 24];
        // assertSame(1, $judgeWin->countWinner($scores));
        // $scores = [12 ,20, 24];
        // assertSame(1, $judgeWin->countWinner($scores));
        // $scores = [12 ,20, 21];
        // assertSame(1, $judgeWin->countWinner($scores));
        // $scores = [12 ,20, 20];
        // assertSame(2, $judgeWin->countWinner($scores));
        // $scores = [12 ,12, 20];
        // assertSame(1, $judgeWin->countWinner($scores));
        // $scores = [12 ,12, 12];
        // assertSame(3, $judgeWin->countWinner($scores));
    }
}
