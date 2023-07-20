<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/RuleThreeCard.php');
require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

final class RuleThreeCardTest extends TestCase
{
    public function testGetHand(): void
    {
        $rule1 = new RuleThreeCard();
        $this->assertSame('high card',       $rule1->getHand([new PokerCard('C3'), new PokerCard('DA'), new PokerCard('D9')]));
        $this->assertSame('pair',            $rule1->getHand([new PokerCard('CA'), new PokerCard('DA'), new PokerCard('D10')]));
        $this->assertSame('straight',        $rule1->getHand([new PokerCard('CA'), new PokerCard('D2'), new PokerCard('D3')]));
        $this->assertSame('straight',        $rule1->getHand([new PokerCard('CA'), new PokerCard('DK'), new PokerCard('DQ')]));
        $this->assertSame('three of a kind', $rule1->getHand([new PokerCard('CA'), new PokerCard('DA'), new PokerCard('DA')]));
    }
}

/*
docker compose exec app ./vendor/bin/phpunit tests/poker/RuleThreeCardTest.php --bootstrap vendor/autoload.php
*/
