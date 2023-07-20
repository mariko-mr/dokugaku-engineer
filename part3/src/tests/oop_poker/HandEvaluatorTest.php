<?php

declare(strict_types=1);

namespace OopPoker\Tests;

use PHPUnit\Framework\TestCase;
use OopPoker\HandEvaluator;
use OopPoker\RuleA;
use OopPoker\Card;

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

    public function testGetWinner(): void
    {
        $this->assertSame(1, HandEvaluator::getWinner('pair', 'straight'));
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/oop_poker/HandEvaluatorTest.php --bootstrap vendor/autoload.php
