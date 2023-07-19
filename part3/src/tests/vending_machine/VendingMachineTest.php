<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/vending_machine/VendingMachine.php');

final class VendingMachineTest extends TestCase
{
    public function testDepositCoin()
    {
        $vendingMachine = new VendingMachine();
        $this->assertSame(0, $vendingMachine->depositCoin(0));
        $this->assertSame(0, $vendingMachine->depositCoin(150));
        $this->assertSame(100, $vendingMachine->depositCoin(100));
    }

    public function testAddCup()
    {
        $vendingMachine = new VendingMachine();
        $this->assertSame(99, $vendingMachine->addCup(99));
        $this->assertSame(100, $vendingMachine->addCup(1));
        $this->assertSame(100, $vendingMachine->addCup(1));
    }

    public function testPressButton()
    {
        $cider = new Drink('cider');
        $coke = new Drink('coke');
        $hotCupCoffee = new CupDrink('hot cup coffee');
        $vendingMachine = new VendingMachine();

        // お金が投入されてない場合は購入できない
        $this->assertSame('', $vendingMachine->pressButton($cider));
        // 100円を入れた後(サイダー)
        $vendingMachine->depositCoin(100);
        $this->assertSame('cider', $vendingMachine->pressButton($cider));

        // 100円を入れた後(コーラ)
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($coke));
        // もう100円を入れた後(コーラ)
        $vendingMachine->depositCoin(100);
        $this->assertSame('coke', $vendingMachine->pressButton($coke));

        // カップを入れた場合は購入できる
        $vendingMachine->addCup(1);
        $vendingMachine->depositCoin(100);
        $this->assertSame('hot cup coffee', $vendingMachine->pressButton($hotCupCoffee));

        // カップが投入されていない場合は購入できない
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($hotCupCoffee));
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/vending_machine/VendingMachineTest.php --bootstrap vendor/autoload.php
