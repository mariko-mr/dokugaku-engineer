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

    /**
     * ここを追加
     */
    public function testAddCup()
    {
        $iceCupCoffee = new CupDrink('ice cup coffee');
        $this->assertSame(50, $iceCupCoffee->addCup(50));
        $this->assertSame(100, $iceCupCoffee->addCup(550));
    }

    /**
     * ここを修正
     * 期待される値を変更
     */
    public function testGetCupNumber()
    {
        $iceCupCoffee = new CupDrink('ice cup coffee');
        $this->assertSame(0, $iceCupCoffee->getCupNumber());
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/vending_machine/CupDrinkTest.php --bootstrap vendor/autoload.php
