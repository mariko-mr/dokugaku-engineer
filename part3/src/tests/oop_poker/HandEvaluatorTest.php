<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/HandEvaluator.php');
require_once(__DIR__ . '/../../lib/oop_poker/Card.php');
require_once(__DIR__ . '/../../lib/oop_poker/RuleA.php');

final class HandEvaluatorTest extends TestCase
{
    public function testGetHand(): void
    {
        $handEvaluator = new HandEvaluator(new RuleA());
        $cards = [new Card('H', 10), new Card('C', 10)];
        $this->assertSame('pair', $handEvaluator->getHand($cards));
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/oop_poker/PlayerTest.php --bootstrap vendor/autoload.php
