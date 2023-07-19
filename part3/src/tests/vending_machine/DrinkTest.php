<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/vending_machine/Drink.php');

final class DrinkTest extends TestCase
{
    public function testGetName()
    {
        $cider = new Drink('cider');
        $this->assertSame('cider', $cider->getName());
    }

    public function testGetPrice()
    {
        $coke = new Drink('coke');
        $this->assertSame(150, $coke->getPrice());
    }

    public function getCupNumber()
    {
        $coke = new Drink('coke');
        $this->assertSame(0, $coke->getCupNumber());
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/vending_machine/DrinkTest.php --bootstrap vendor/autoload.php
