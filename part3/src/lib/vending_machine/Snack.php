<?php

namespace VendingMachine;

require_once(__DIR__ . '/../../lib/vending_machine/DepositItem.php');

class Snack extends DepositItem
{
    private const PRICE = [
        'potato chips' => 150,
    ];

    private const MAX_STOCK = [
        'potato chips' => 50,
    ];

    private array $snackStock = [
        'potato chips' => 0,
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
        if ($this->snackStock[$this->name] + $stockNumber > self::MAX_STOCK[$this->name]) {
            return $this->snackStock[$this->name] = self::MAX_STOCK[$this->name];
        }

        return $this->snackStock[$this->name] += $stockNumber;
    }

    /**
     * ここを修正
     * 変数名を変更
     */
    public function getStockNumber(): int
    {
        return $this->snackStock[$this->name];
    }

    public function reduceStock(): void
    {
        $this->snackStock[$this->name]--;
    }
}
