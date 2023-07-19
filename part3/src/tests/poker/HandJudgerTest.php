<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/HandJudger.php');

final class HandJudgerTest extends TestCase
{
    public function testGetHands(): void
    {
        $handJudger = new HandJudger([new PokerCard('C3'), new PokerCard('DA')]);
        $this->assertSame('high card', $handJudger->getHand());

        $handJudger = new HandJudger([new PokerCard('CA'), new PokerCard('DA')]);
        $this->assertSame('pair', $handJudger->getHand());

        $handJudger = new HandJudger([new PokerCard('CA'), new PokerCard('D2')]);
        $this->assertSame('straight', $handJudger->getHand());

        $handJudger = new HandJudger([new PokerCard('CA'), new PokerCard('DK')]);
        $this->assertSame('straight', $handJudger->getHand());
    }
}

/*
docker compose exec app ./vendor/bin/phpunit tests/poker/HandJudgerTest.php --bootstrap vendor/autoload.php
*/
