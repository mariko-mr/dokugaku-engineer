<?php

namespace VendingMachine;

require_once(__DIR__ . '/../../lib/vending_machine/Item.php');

class CupDrink extends DepositCupItem
{
    private const PRICE = [
        'hot cup coffee' => 100,
        'ice cup coffee' => 100,
    ];

    private const MAX_CUP = 100;

    private int $cupStock = 0;

    public function getPrice(): int
    {
        return self::PRICE[$this->name];
    }

    /**
     * ここを追加
     */
    public function addCup(int $cupNumber): int
    {
        if (($this->cupStock + $cupNumber) > self::MAX_CUP) {
            return $this->cupStock = self::MAX_CUP;
        }

        return $this->cupStock += $cupNumber;
    }

    /**
     * ここを修正
     * 戻り値を変更
     */
    public function getCupNumber(): int
    {
        return $this->cupStock;
    }

    /**
     * ここを修正
     * getStock()の削除
     */

    /**
     * ここを修正
     */
    public function reduceCup(): void
    {
        $this->cupStock--;
    }
}
