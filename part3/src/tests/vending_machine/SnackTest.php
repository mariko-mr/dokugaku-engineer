<?php

declare(strict_types=1);

namespace VendingMachine\Tests;

use PHPUnit\Framework\TestCase;
use VendingMachine\Snack;

require_once(__DIR__ . '/../../lib/vending_machine/Snack.php');

final class SnackTest extends TestCase
{
    public function testGetName()
    {
        $potatoChips = new Snack('potato chips');
        $this->assertSame('potato chips', $potatoChips->getName());
    }

    public function testGetPrice()
    {
        $potatoChips = new Snack('potato chips');
        $this->assertSame(150, $potatoChips->getPrice());
    }

    public function getCupNumber()
    {
        $potatoChips = new Snack('potato chips');
        $this->assertSame(0, $potatoChips->getCupNumber());
    }
}

// docker compose exec app ./vendor/bin/phpunit tests/vending_machine/SnackTest.php --bootstrap vendor/autoload.php
