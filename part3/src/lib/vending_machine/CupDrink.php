<?php

require_once(__DIR__ . '/../../lib/vending_machine/Item.php');
class CupDrink extends Item
{
    private const DRINK = [
        'hot cup coffee' => 100,
        'ice cup coffee' => 100,
    ];

    public function getPrice(): int
    {
        return self::DRINK[$this->name];
    }

    public function getCupNumber(): int
    {
        return 1;
    }
}
