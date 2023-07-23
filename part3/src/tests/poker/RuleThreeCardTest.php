<?php

declare(strict_types=1);

namespace Poker\Tests;

use PHPUnit\Framework\TestCase;
use Poker\RuleThreeCard;
use Poker\PokerCard;

require_once(__DIR__ . '/../../lib/poker/RuleThreeCard.php');
require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

final class RuleThreeCardTest extends TestCase
{
    public function testGetHand(): void
    {
        $rule = new RuleThreeCard();
        $this->assertSame(['hand_name' => 'high card',       'hand_rank' => 1, 'card_rank_1' => 13,  'card_rank_2' => 8,  'card_rank_3' => 2],   $rule->getHand([new PokerCard('C3'), new PokerCard('DA'), new PokerCard('D9')]));
        $this->assertSame(['hand_name' => 'pair',            'hand_rank' => 2, 'card_rank_1' => 13,  'card_rank_2' => 13, 'card_rank_3' => 9],   $rule->getHand([new PokerCard('CA'), new PokerCard('DA'), new PokerCard('D10')]));
        $this->assertSame(['hand_name' => 'straight',        'hand_rank' => 3, 'card_rank_1' => 13,  'card_rank_2' => 2,  'card_rank_3' => 1],   $rule->getHand([new PokerCard('CA'), new PokerCard('D2'), new PokerCard('D3')]));
        $this->assertSame(['hand_name' => 'straight',        'hand_rank' => 3, 'card_rank_1' => 13, 'card_rank_2' => 12, 'card_rank_3' => 11],   $rule->getHand([new PokerCard('CA'), new PokerCard('DK'), new PokerCard('DQ')]));
        $this->assertSame(['hand_name' => 'three of a kind', 'hand_rank' => 4, 'card_rank_1' => 13, 'card_rank_2' => 13, 'card_rank_3' => 13],   $rule->getHand([new PokerCard('CA'), new PokerCard('DA'), new PokerCard('DA')]));
    }

    /**
     * TODO: ここを追加
     */
    // public function testGetWinner(): void
    // {
    //     $rule = new RuleThreeCard();
    //     $this->assertSame(1, $rule->getWinner());
    //     $this->assertSame(1, $rule->getWinner());
    //     $this->assertSame(1, $rule->getWinner());
    //     $this->assertSame(1, $rule->getWinner());
    // }
}

/*
docker compose exec app ./vendor/bin/phpunit tests/poker/RuleThreeCardTest.php --bootstrap vendor/autoload.php
*/
