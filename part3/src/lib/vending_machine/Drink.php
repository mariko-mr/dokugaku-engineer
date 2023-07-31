<?php

namespace VendingMachine;

require_once(__DIR__ . '/../../lib/vending_machine/DepositItem.php');

class Drink extends DepositItem
{
    private const PRICE = [
        'cider' => 100,
        'coke' => 150,
    ];

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

    /**
     * ここを修正
     * $stockを$stockNumberに変更
     */
    public function depositItem(int $stockNumber): int
    {
        if ($this->drinkStock[$this->name] + $stockNumber > self::MAX_STOCK[$this->name]) {
            return $this->drinkStock[$this->name] = self::MAX_STOCK[$this->name];
        }

        return $this->drinkStock[$this->name] += $stockNumber;
    }

    /**
     * ここを修正
     * 変数名を変更
     */
    public function getStockNumber(): int
    {
        return $this->drinkStock[$this->name];
    }

    public function reduceStock(): void
    {
        $this->drinkStock[$this->name]--;
    }
}
