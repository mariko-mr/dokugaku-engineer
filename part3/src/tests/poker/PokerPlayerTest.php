<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/PokerPlayer.php');
require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

final class PokerPlayerTest extends TestCase
{
    public function testPokerStart(): void
    {
        $player = new PokerPlayer([new PokerCard('CA'), new PokerCard('D10')]);
        $this->assertSame([13, 9], $player->getRanks());
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/poker/PokerPlayerTest.php --bootstrap vendor/autoload.php
