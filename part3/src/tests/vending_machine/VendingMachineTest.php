<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/vending_machine/VendingMachine.php');

final class VendingMachineTest extends TestCase
{
    public function testPressButton()
    {
        $vendingMachine = new VendingMachine();
        $this->assertSame('cider', $vendingMachine->pressButton());
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/vending_machine/VendingMachineTest.php --bootstrap vendor/autoload.php
