<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/PokerGame.php');
require_once(__DIR__ . '/../../lib/poker/PokerPlayer.php');
require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

final class PokerGameTest extends TestCase
{
    public function testPokerStart(): void
    {
        $game = new PokerGame(['CA', 'DA'], ['C10', 'H10']);
        $this->assertSame([[13, 13], [9, 9]], $game->pokerStart());
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/poker/PokerGameTest.php --bootstrap vendor/autoload.php
