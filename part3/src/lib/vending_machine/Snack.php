<?php

require_once(__DIR__ . '/../../lib/vending_machine/Item.php');

class Snack extends Item
{
    private const PRICE = [
        'potato chips' => 150,
    ];

    public function getPrice(): int
    {
        return self::PRICE[$this->name];
    }

    public function getCupNumber(): int
    {
        return 0;
    }
}