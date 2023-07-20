<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/RuleFiveCard.php');
require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

final class RuleFiveCardTest extends TestCase
{
    public function testGetHand(): void
    {
        $rule = new RuleFiveCard();
        $this->assertSame('high card',       $rule->getHand([new PokerCard('C3'), new PokerCard('DA'), new PokerCard('C4'), new PokerCard('D5'), new PokerCard('C8')]));
        $this->assertSame('one pair',        $rule->getHand([new PokerCard('C3'), new PokerCard('D3'), new PokerCard('C4'), new PokerCard('D5'), new PokerCard('C8')]));
        $this->assertSame('two pair',        $rule->getHand([new PokerCard('C3'), new PokerCard('D3'), new PokerCard('C4'), new PokerCard('D4'), new PokerCard('C8')]));
        $this->assertSame('three of a kind', $rule->getHand([new PokerCard('C3'), new PokerCard('D3'), new PokerCard('S3'), new PokerCard('D5'), new PokerCard('C8')]));

        $this->assertSame('straight',        $rule->getHand([new PokerCard('CA'), new PokerCard('D2'), new PokerCard('C3'), new PokerCard('D4'), new PokerCard('C5')]));
        $this->assertSame('straight',        $rule->getHand([new PokerCard('CA'), new PokerCard('DK'), new PokerCard('CQ'), new PokerCard('DJ'), new PokerCard('C10')]));

        $this->assertSame('full house',      $rule->getHand([new PokerCard('C3'), new PokerCard('D3'), new PokerCard('S3'), new PokerCard('D5'), new PokerCard('C5')]));

        $this->assertSame('four of a kind',  $rule->getHand([new PokerCard('C3'), new PokerCard('D3'), new PokerCard('S3'), new PokerCard('H3'), new PokerCard('C8')]));
    }
}

/*
docker compose exec app ./vendor/bin/phpunit tests/poker/RuleFiveCardTest.php --bootstrap vendor/autoload.php
*/
