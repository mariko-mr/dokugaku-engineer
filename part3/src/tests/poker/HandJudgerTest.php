<?php

declare(strict_types=1);

namespace Poker\Tests;

use PHPUnit\Framework\TestCase;
use Poker\HandJudger;
use Poker\RuleTwoCard;
use Poker\PokerCard;

require_once(__DIR__ . '/../../lib/poker/HandJudger.php');
require_once(__DIR__ . '/../../lib/poker/RuleTwoCard.php');

final class HandJudgerTest extends TestCase
{
    public function testGetHand(): void
    {
        $handJudger = new HandJudger(new RuleTwoCard());
        $this->assertSame(['hand_name' => 'high card', 'hand_rank' => 1, 'card_rank_1' => 13,  'card_rank_2' => 2], $handJudger->getHand([new PokerCard('C3'), new PokerCard('DA')]));
        $this->assertSame(['hand_name' => 'pair',      'hand_rank' => 2, 'card_rank_1' => 13, 'card_rank_2' => 13], $handJudger->getHand([new PokerCard('CA'), new PokerCard('DA')]));
        $this->assertSame(['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 1,  'card_rank_2' => 13], $handJudger->getHand([new PokerCard('CA'), new PokerCard('D2')]));
        $this->assertSame(['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 13, 'card_rank_2' => 12], $handJudger->getHand([new PokerCard('CA'), new PokerCard('DK')]));
    }

    /**
     * ここを追加
     *
     */
    public function testGetWinner(): void
    {
        $handJudger = new HandJudger(new RuleTwoCard());
        $this->assertSame(2, $handJudger->getWinner(['hand_name' => 'high card', 'hand_rank' => 1, 'card_rank_1' => 12, 'card_rank_2' => 10], ['hand_name' => 'pair',      'hand_rank' => 2, 'card_rank_1' => 9,  'card_rank_2' => 9]));
        $this->assertSame(2, $handJudger->getWinner(['hand_name' => 'high card', 'hand_rank' => 1, 'card_rank_1' => 12, 'card_rank_2' => 10], ['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 3,  'card_rank_2' => 2]));
        $this->assertSame(1, $handJudger->getWinner(['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 3,  'card_rank_2' => 2],  ['hand_name' => 'pair',      'hand_rank' => 2, 'card_rank_1' => 12, 'card_rank_2' => 12]));
        $this->assertSame(1, $handJudger->getWinner(['hand_name' => 'high card', 'hand_rank' => 1, 'card_rank_1' => 12, 'card_rank_2' => 10], ['hand_name' => 'high card', 'hand_rank' => 1, 'card_rank_1' => 11, 'card_rank_2' => 9]));
        $this->assertSame(2, $handJudger->getWinner(['hand_name' => 'high card', 'hand_rank' => 1, 'card_rank_1' => 12, 'card_rank_2' => 8],  ['hand_name' => 'high card', 'hand_rank' => 1, 'card_rank_1' => 12, 'card_rank_2' => 9]));
        $this->assertSame(0, $handJudger->getWinner(['hand_name' => 'high card', 'hand_rank' => 1, 'card_rank_1' => 4,  'card_rank_2' => 2],  ['hand_name' => 'high card', 'hand_rank' => 1, 'card_rank_1' => 4,  'card_rank_2' => 2]));
        $this->assertSame(1, $handJudger->getWinner(['hand_name' => 'pair',      'hand_rank' => 2, 'card_rank_1' => 13, 'card_rank_2' => 13], ['hand_name' => 'pair',      'hand_rank' => 2, 'card_rank_1' => 1,  'card_rank_2' => 1]));
        $this->assertSame(2, $handJudger->getWinner(['hand_name' => 'pair',      'hand_rank' => 2, 'card_rank_1' => 12, 'card_rank_2' => 12], ['hand_name' => 'pair',      'hand_rank' => 2, 'card_rank_1' => 13, 'card_rank_2' => 13]));
        $this->assertSame(0, $handJudger->getWinner(['hand_name' => 'pair',      'hand_rank' => 2, 'card_rank_1' => 3,  'card_rank_2' => 3],  ['hand_name' => 'pair',      'hand_rank' => 2, 'card_rank_1' => 3,  'card_rank_2' => 3]));
        $this->assertSame(1, $handJudger->getWinner(['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 13, 'card_rank_2' => 12], ['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 1,  'card_rank_2' => 13]));
        $this->assertSame(2, $handJudger->getWinner(['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 1,  'card_rank_2' => 13], ['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 2,  'card_rank_2' => 1]));
        $this->assertSame(0, $handJudger->getWinner(['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 2,  'card_rank_2' => 1],  ['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 2,  'card_rank_2' => 1]));
        $this->assertSame(0, $handJudger->getWinner(['hand_name' => 'pair',      'hand_rank' => 2, 'card_rank_1' => 13, 'card_rank_2' => 13], ['hand_name' => 'pair',      'hand_rank' => 2, 'card_rank_1' => 13, 'card_rank_2' => 13]));
        $this->assertSame(1, $handJudger->getWinner(['hand_name' => 'high card', 'hand_rank' => 1, 'card_rank_1' => 13, 'card_rank_2' => 2],  ['hand_name' => 'high card', 'hand_rank' => 1, 'card_rank_1' => 3,  'card_rank_2' => 1]));
    }
}

/*
docker compose exec app ./vendor/bin/phpunit tests/poker/HandJudgerTest.php --bootstrap vendor/autoload.php
*/
