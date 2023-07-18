<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/Game.php');

final class GameTest extends TestCase
{
    public function testStart(): void
    {
        $game = new Game('まこと', 2, 'A');
        $result = $game->start();
        $this->assertSame('pair', $result);
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/oop_poker/GameTest.php --bootstrap vendor/autoload.php
