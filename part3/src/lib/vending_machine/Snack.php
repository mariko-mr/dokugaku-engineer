<?php

namespace VendingMachine;

require_once(__DIR__ . '/../../lib/vending_machine/DepositItem.php');

class Snack extends DepositItem
{
    private const PRICE = [
        'potato chips' => 150,
    ];

    /**
     * ここを追加
     */
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

    public function getCupNumber(): int
    {
        return 0;
    }

    /**
     * ここを追加
     */
    public function depositItem(int $stock): int
    {
        if ($this->snackStock[$this->name] + $stock > self::MAX_STOCK[$this->name]) {
            return $this->snackStock[$this->name] = self::MAX_STOCK[$this->name];
        }

        return $this->snackStock[$this->name] += $stock;
    }
}
