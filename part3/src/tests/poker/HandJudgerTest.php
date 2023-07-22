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
        $this->assertSame('high card', $handJudger->getHand([new PokerCard('C3'), new PokerCard('DA')]));
        $this->assertSame('pair', $handJudger->getHand([new PokerCard('CA'), new PokerCard('DA')]));
        $this->assertSame('straight', $handJudger->getHand([new PokerCard('CA'), new PokerCard('D2')]));
        $this->assertSame('straight', $handJudger->getHand([new PokerCard('CA'), new PokerCard('DK')]));
    }
}

/*
docker compose exec app ./vendor/bin/phpunit tests/poker/HandJudgerTest.php --bootstrap vendor/autoload.php
*/
