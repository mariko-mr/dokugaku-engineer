<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/vending_machine/Item.php');

final class ItemTest extends TestCase
{
    public function testGetName()
    {
        $item = new Item('cider', 100);
        $this->assertSame('cider', $item->getName());
    }

    public function testGetPrice()
    {
        $item = new Item('coke', 150);
        $this->assertSame(150, $item->getPrice());
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/vending_machine/ItemTest.php --bootstrap vendor/autoload.php
