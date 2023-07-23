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
        $this->assertSame(['hand_name' => 'high card', 'hand_rank' => 1, 'card_rank_1' => 2,  'card_rank_2' => 13], $handJudger->getHand([new PokerCard('C3'), new PokerCard('DA')]));
        $this->assertSame(['hand_name' => 'pair',      'hand_rank' => 2, 'card_rank_1' => 13, 'card_rank_2' => 13], $handJudger->getHand([new PokerCard('CA'), new PokerCard('DA')]));
        $this->assertSame(['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 1,  'card_rank_2' => 13], $handJudger->getHand([new PokerCard('CA'), new PokerCard('D2')]));
        $this->assertSame(['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 12, 'card_rank_2' => 13], $handJudger->getHand([new PokerCard('CA'), new PokerCard('DK')]));
    }

    /**
     * TODO: ここを追加
     *
     */
    public function testGetWinner(): void
    {
        $handJudger = new HandJudger(new RuleTwoCard());
        $this->assertSame(1, $handJudger->getWinner());
        $this->assertSame(1, $handJudger->getWinner());
        $this->assertSame(1, $handJudger->getWinner());
        $this->assertSame(1, $handJudger->getWinner());
    }
}

/*
docker compose exec app ./vendor/bin/phpunit tests/poker/HandJudgerTest.php --bootstrap vendor/autoload.php
*/
