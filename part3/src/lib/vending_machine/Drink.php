<?php

require_once(__DIR__ . '/../../lib/vending_machine/Item.php');
class Drink extends Item
{
    private const DRINK = [
        'cider' => 100,
        'coke' => 150,
    ];

    public function getPrice(): int
    {
        return self::DRINK[$this->name];
    }

    public function getCupNumber(): int
    {
        return 0;
    }
}
