<?php

declare(strict_types=1);

namespace VendingMachine\Tests;

use PHPUnit\Framework\TestCase;
use VendingMachine\Drink;

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

    public function testGetCupNumber()
    {
        $coke = new Drink('coke');
        $this->assertSame(0, $coke->getCupNumber());
    }

    public function testDepositItem()
    {
        $coke = new Drink('coke');
        $this->assertSame(50, $coke->depositItem(50));
        $this->assertSame(70, $coke->depositItem(30));
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/vending_machine/DrinkTest.php --bootstrap vendor/autoload.php
