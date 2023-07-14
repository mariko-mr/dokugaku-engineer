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
        $vendingMachine = new VendingMachine();

        $this->assertSame('', $vendingMachine->pressButton());

        // 100円を入れた後の状態をテストするため、100円を追加する
        $vendingMachine->depositCoin(100);
        $this->assertSame('cider', $vendingMachine->pressButton());

    }
}

// docker compose exec app ./vendor/bin/phpunit tests/vending_machine/VendingMachineTest.php --bootstrap vendor/autoload.php
