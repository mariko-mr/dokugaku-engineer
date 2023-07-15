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

    public function testPressButton()
    {
        $item = new Item('cider', 100);
        $vendingMachine = new VendingMachine();
        $this->assertSame('', $vendingMachine->pressButton($item));

        // 100円を入れた後(サイダー)
        $vendingMachine->depositCoin(100);
        $this->assertSame('cider', $vendingMachine->pressButton($item));

        $item = new Item('coke', 150);
        $vendingMachine = new VendingMachine();
        $this->assertSame('', $vendingMachine->pressButton($item));
        // 100円を入れた後(コーラ)
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($item));

        // 200円を入れた後(コーラ)
        $vendingMachine->depositCoin(100);
        $vendingMachine->depositCoin(100);
        $this->assertSame('coke', $vendingMachine->pressButton($item));
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/vending_machine/VendingMachineTest.php --bootstrap vendor/autoload.php
