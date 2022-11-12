<?php

namespace Blackjack\Tests;

use PHPUnit\Framework\TestCase;
use Blackjack\ScoreCounter;

use function PHPUnit\Framework\assertSame;

require_once(__DIR__ . '/../../lib/Blackjack/ScoreCounter.php');

class ScoreCounterTest extends TestCase
{
    public function testConvertToScore()
    {
        $scoreCounter = new ScoreCounter();
        //2枚
        $cards = ['H10', 'D10'];
        assertSame(20, $scoreCounter->convertToScore($cards));

        $cards = ['H10', 'DA'];
        assertSame(21, $scoreCounter->convertToScore($cards));

        $cards = ['HA', 'DA'];
        assertSame(12, $scoreCounter->convertToScore($cards));

        //3枚
        $cards = ['HQ', 'D9', 'S2'];
        assertSame(21, $scoreCounter->convertToScore($cards));

        $cards = ['H10', 'DA', 'SQ'];
        assertSame(21, $scoreCounter->convertToScore($cards));

        $cards = ['H2', 'DA', 'SA'];
        assertSame(14, $scoreCounter->convertToScore($cards));

        $cards = ['HA', 'DA', 'SA'];
        assertSame(13, $scoreCounter->convertToScore($cards));

        //4枚
        $cards = ['D3', 'SQ', 'C4', 'H3'];
        assertSame(20, $scoreCounter->convertToScore($cards));

        $cards = ['DA', 'SQ', 'C2', 'H2'];
        assertSame(15, $scoreCounter->convertToScore($cards));

        $cards = ['DA', 'S3', 'C2', 'H2'];
        assertSame(18, $scoreCounter->convertToScore($cards));

        $cards = ['DA', 'SA', 'C6', 'H3'];
        assertSame(21, $scoreCounter->convertToScore($cards));

        $cards = ['DA', 'SA', 'CA', 'H6'];
        assertSame(19, $scoreCounter->convertToScore($cards));

        $cards = ['DA', 'SA', 'CA', 'HA'];
        assertSame(14, $scoreCounter->convertToScore($cards));

        //5枚
        $cards = ['DA', 'S2', 'C3', 'H4', 'H2'];
        assertSame(12, $scoreCounter->convertToScore($cards));

        $cards = ['DA', 'SQ', 'C8', 'H2', 'H2'];
        assertSame(23, $scoreCounter->convertToScore($cards));

        $cards = ['DA', 'SA', 'C2', 'H2', 'H3'];
        assertSame(19, $scoreCounter->convertToScore($cards));

        $cards = ['DA', 'SA', 'CQ', 'H2', 'H3'];
        assertSame(17, $scoreCounter->convertToScore($cards));

        $cards = ['DA', 'SA', 'CA', 'H2', 'H3'];
        assertSame(18, $scoreCounter->convertToScore($cards));

        $cards = ['DA', 'SA', 'CA', 'HJ', 'H6'];
        assertSame(19, $scoreCounter->convertToScore($cards));

        $cards = ['DA', 'SA', 'CA', 'HA', 'HK'];
        assertSame(14, $scoreCounter->convertToScore($cards));

        $cards = ['DA', 'SA', 'CA', 'HA', 'H6'];
        assertSame(20, $scoreCounter->convertToScore($cards));
    }
}
