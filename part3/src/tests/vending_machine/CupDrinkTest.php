<?php

declare(strict_types=1);

namespace VendingMachine\Tests;

use PHPUnit\Framework\TestCase;
use VendingMachine\CupDrink;

require_once(__DIR__ . '/../../lib/vending_machine/CupDrink.php');

final class CupDrinkTest extends TestCase
{
    public function testGetName()
    {
        $hotCupCoffee = new CupDrink('hot cup coffee');
        $this->assertSame('hot cup coffee', $hotCupCoffee->getName());
    }

    public function testGetPrice()
    {
        $iceCupCoffee = new CupDrink('ice cup coffee');
        $this->assertSame(100, $iceCupCoffee->getPrice());
    }

    public function getCupNumber()
    {
        $iceCupCoffee = new CupDrink('ice cup coffee');
        $this->assertSame(1, $iceCupCoffee->getCupNumber());
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/vending_machine/DrinkTest.php --bootstrap vendor/autoload.php
