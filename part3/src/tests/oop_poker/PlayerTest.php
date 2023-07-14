<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/Player.php');

final class PlayerTest extends TestCase
{
    public function testDrawCards(): void
    {
        $player = new Player('まこと');
        $cards = $player->drawCards();
        $this->assertSame(2, count($cards));
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/oop_poker/PlayerTest.php --bootstrap vendor/autoload.php
