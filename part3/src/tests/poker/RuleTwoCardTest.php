<?php

declare(strict_types=1);

namespace Poker\Tests;

use PHPUnit\Framework\TestCase;
use Poker\RuleTwoCard;
use Poker\PokerCard;

require_once(__DIR__ . '/../../lib/poker/RuleTwoCard.php');
require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

final class RuleTwoCardTest extends TestCase
{
    public function testGetHand(): void
    {
        $rule = new RuleTwoCard();
        $this->assertSame(['hand_name' => 'high card', 'hand_rank' => 1, 'card_rank_1' => 13,  'card_rank_2' => 2], $rule->getHand([new PokerCard('C3'), new PokerCard('DA')]));
        $this->assertSame(['hand_name' => 'pair',      'hand_rank' => 2, 'card_rank_1' => 13, 'card_rank_2' => 13], $rule->getHand([new PokerCard('CA'), new PokerCard('DA')]));
        $this->assertSame(['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 13,  'card_rank_2' => 1], $rule->getHand([new PokerCard('CA'), new PokerCard('D2')]));
        $this->assertSame(['hand_name' => 'straight',  'hand_rank' => 3, 'card_rank_1' => 13, 'card_rank_2' => 12], $rule->getHand([new PokerCard('CA'), new PokerCard('DK')]));
    }

    /**
     * TODO: ここを追加
     */
    // public function testGetWinner(): void
    // {
    //     $rule = new RuleTwoCard();
    //     $this->assertSame(1, $rule->getWinner());
    //     $this->assertSame(1, $rule->getWinner());
    //     $this->assertSame(1, $rule->getWinner());
    //     $this->assertSame(1, $rule->getWinner());
    // }
}

/*
docker compose exec app ./vendor/bin/phpunit tests/poker/RuleTwoCardTest.php --bootstrap vendor/autoload.php
*/
