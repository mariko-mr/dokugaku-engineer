<?php

namespace VendingMachine;

require_once(__DIR__ . '/../../lib/vending_machine/DepositItem.php');

class Drink extends DepositItem
{
    private const PRICE = [
        'cider' => 100,
        'coke' => 150,
    ];

    /**
     * ここを追加
     */
    private const MAX_STOCK = [
        'cider' => 50,
        'coke' => 70,
    ];

    private array $drinkStock = [
        'cider' => 0,
        'coke' => 0,
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
     * ここを追加
     */
    public function depositItem(int $stock): int
    {
        if ($this->drinkStock[$this->name] + $stock > self::MAX_STOCK[$this->name]) {
            return $this->drinkStock[$this->name] = self::MAX_STOCK[$this->name];
        }

        return $this->drinkStock[$this->name] += $stock;
    }
}
