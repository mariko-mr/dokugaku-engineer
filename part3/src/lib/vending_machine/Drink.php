<?php

namespace VendingMachine;

require_once(__DIR__ . '/../../lib/vending_machine/Item.php');

class Drink extends DepositItem
{
    private const PRICE = [
        'cider' => 100,
        'coke' => 150,
    ];

    public function getPrice(): int
    {
        return self::PRICE[$this->name];
    }

    public function getCupNumber(): int
    {
        return 0;
    }

    /**
     * TODO: ここを追加
     */
    public function getMaxDeposit(): int
    {
        // TODO
    }
}
