<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/RuleTwoCard.php');
require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

final class RuleTwoCardTest extends TestCase
{
    public function testGetHand(): void
    {
        $rule1 = new RuleTwoCard();
        $this->assertSame('high card',  $rule1->getHand([new PokerCard('C3'), new PokerCard('DA')]));
        $this->assertSame('pair',       $rule1->getHand([new PokerCard('CA'), new PokerCard('DA')]));
        $this->assertSame('straight',   $rule1->getHand([new PokerCard('CA'), new PokerCard('D2')]));
        $this->assertSame('straight',   $rule1->getHand([new PokerCard('CA'), new PokerCard('DK')]));
    }
}

/*
docker compose exec app ./vendor/bin/phpunit tests/poker/RuleTwoCardTest.php --bootstrap vendor/autoload.php
*/
