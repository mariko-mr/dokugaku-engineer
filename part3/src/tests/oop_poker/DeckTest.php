<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/Deck.php');

final class DeckTest extends TestCase
{
    public function testDrawCards(): void
    {
        $deck = new Deck();
        $cards = $deck->drawCards(2);
        $this->assertSame(2, count($cards));
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/oop_poker/DeckTest.php --bootstrap vendor/autoload.php
