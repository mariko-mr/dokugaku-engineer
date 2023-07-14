<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/Card.php');

final class CardTest extends TestCase
{
    public function testGetSuit(): void
    {
        $card = new Card('C', 5);
        $this->assertSame('C', $card->getSuit());
    }

    public function testGetNumber(): void
    {
        $card = new Card('C', 5);
        $this->assertSame(5, $card->getNumber());
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/oop_poker/CardTest.php --bootstrap vendor/autoload.php
