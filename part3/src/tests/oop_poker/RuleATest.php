<?php

declare(strict_types=1);

namespace OopPoker\Tests;

use PHPUnit\Framework\TestCase;
use OopPoker\RuleA;
use OopPoker\Card;

require_once(__DIR__ . '/../../lib/oop_poker/RuleA.php');
require_once(__DIR__ . '/../../lib/oop_poker/Card.php');

final class RuleATest extends TestCase
{
    public function testGetHand(): void
    {
        $rule = new RuleA();
        $cards = [new Card('H', 10), new Card('C', 10)];
        $this->assertSame('pair', $rule->getHand($cards));
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/oop_poker/RuleATest.php --bootstrap vendor/autoload.php
