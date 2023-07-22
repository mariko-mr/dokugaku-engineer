<?php

declare(strict_types=1);

namespace Poker\Tests;

use PHPUnit\Framework\TestCase;
use Poker\PokerCard;

require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

final class PokerCardTest extends TestCase
{
    public function testPokerStart(): void
    {
        $card = new PokerCard('CA');
        $this->assertSame(13, $card->getRank());
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/poker/PokerCardTest.php --bootstrap vendor/autoload.php
