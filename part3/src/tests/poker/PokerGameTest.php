<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/PokerGame.php');

final class PokerGameTest extends TestCase
{
    public function testPokerStart(): void
    {
        $game = new PokerGame(['CA', 'DA']);
        $this->assertSame(['CA', 'DA'], $game->pokerStart());
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/poker/PokerGameTest.php --bootstrap vendor/autoload.php
