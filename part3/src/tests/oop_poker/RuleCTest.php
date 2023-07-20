<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/oop_poker/RuleC.php');
require_once(__DIR__ . '/../../lib/oop_poker/Card.php');

final class RuleCTest extends TestCase
{
    public function testGetHand(): void
    {
        $rule = new RuleC();
        $cards = [new Card('H', 10), new Card('C', 10)];
        $this->assertSame('straight', $rule->getHand($cards));
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/oop_poker/RuleCTest.php --bootstrap vendor/autoload.php
