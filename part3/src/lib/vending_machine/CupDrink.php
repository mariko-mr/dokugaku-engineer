<?php

namespace VendingMachine;

require_once(__DIR__ . '/../../lib/vending_machine/Item.php');

class CupDrink extends Item
{
    private const PRICE = [
        'hot cup coffee' => 100,
        'ice cup coffee' => 100,
    ];

    public function getPrice(): int
    {
        return self::PRICE[$this->name];
    }

    public function getCupNumber(): int
    {
        return 1;
    }

    /**
     * ここを追加
     */
    public function getStock(): int
    {
        return 1;
    }

    /**
     * ここを追加
     */
    public function reduceStock(): void
    {
    }
}
