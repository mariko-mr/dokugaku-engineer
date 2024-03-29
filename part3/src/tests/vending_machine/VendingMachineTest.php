<?php

declare(strict_types=1);

namespace VendingMachine\Tests;

use PHPUnit\Framework\TestCase;
use VendingMachine\VendingMachine;
use VendingMachine\Drink;
use VendingMachine\CupDrink;
use VendingMachine\Snack;

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
        $hotCupCoffee = new CupDrink('hot cup coffee');
        $this->assertSame(99, $vendingMachine->addCup($hotCupCoffee, 99));
        $this->assertSame(100, $vendingMachine->addCup($hotCupCoffee, 1));
        $this->assertSame(100, $vendingMachine->addCup($hotCupCoffee, 1));
    }

    public function testDepositItem()
    {
        $vendingMachine = new VendingMachine();
        $cider = new Drink('cider');
        # サイダーの在庫の上限が50個の場合
        $this->assertSame(50, $vendingMachine->depositItem($cider, 50));
        $this->assertSame(50, $vendingMachine->depositItem($cider, 1));
    }

    public function testReceiveChange()
    {
        $vendingMachine = new VendingMachine();
        $this->assertSame(0, $vendingMachine->receiveChange());

        $vendingMachine->depositCoin(100);
        $this->assertSame(100, $vendingMachine->receiveChange());

        $vendingMachine->depositCoin(100);
        $vendingMachine->depositCoin(100);
        $this->assertSame(200, $vendingMachine->receiveChange());
    }

    /**
     * ここを修正
     */
    public function testPressButton()
    {
        $vendingMachine = new VendingMachine();
        $cider = new Drink('cider');
        $coke = new Drink('coke');
        $hotCupCoffee = new CupDrink('hot cup coffee');
        $potatoChips = new Snack('potato chips');

        // お金が投入されてない場合は購入できない
        $this->assertSame('', $vendingMachine->pressButton($cider));

        // 商品の在庫がないと購入できない
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($cider));
        // 商品の在庫があると購入できる
        $vendingMachine->depositItem($cider, 1);
        $this->assertSame('cider', $vendingMachine->pressButton($cider));

        // 投入金額が100円の場合はコーラを購入できない
        $vendingMachine->depositCoin(100);
        $vendingMachine->depositItem($coke, 1);
        $this->assertSame('', $vendingMachine->pressButton($coke));
        // もう100円を入れた後(コーラ)
        $vendingMachine->depositCoin(100);
        $this->assertSame('coke', $vendingMachine->pressButton($coke));

        // コーラのあまり50円に追加して100円を入れた後(ポテトチップス)
        $vendingMachine->depositCoin(100);
        $vendingMachine->depositItem($potatoChips, 1);
        $this->assertSame('potato chips', $vendingMachine->pressButton($potatoChips));

        // カップを入れた場合は購入できる
        $vendingMachine->addCup($hotCupCoffee, 1);
        $vendingMachine->depositCoin(100);
        $this->assertSame('hot cup coffee', $vendingMachine->pressButton($hotCupCoffee));

        // カップが投入されていない場合は購入できない
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($hotCupCoffee));
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/vending_machine/VendingMachineTest.php --bootstrap vendor/autoload.php
