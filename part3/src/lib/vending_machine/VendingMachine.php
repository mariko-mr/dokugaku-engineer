<?php

namespace VendingMachine;

require_once(__DIR__ . '/../../lib/vending_machine/Item.php');
require_once(__DIR__ . '/../../lib/vending_machine/DepositItem.php');
require_once(__DIR__ . '/../../lib/vending_machine/DepositCupItem.php');
require_once(__DIR__ . '/../../lib/vending_machine/Drink.php');
require_once(__DIR__ . '/../../lib/vending_machine/CupDrink.php');
require_once(__DIR__ . '/../../lib/vending_machine/Snack.php');

class VendingMachine
{
    private int $depositedCoin = 0;
    private const COIN = 100;

    public function depositCoin(int $coin): int
    {
        if ($coin === self::COIN) {
            $this->depositedCoin += $coin;
        }
        return $this->depositedCoin;
    }

    /**
     * ここを修正
     */
    public function addCup(DepositCupItem $item, int $cupNumber): int
    {
        return $item->addCup($cupNumber);
    }

    public function depositItem(DepositItem $item, int $stockNumber): int
    {
        return $item->depositItem($stockNumber);
    }

    public function receiveChange(): int
    {
        $receiveCoin = $this->depositedCoin;
        $this->depositedCoin -= $receiveCoin;
        return $receiveCoin;
    }

    /**
     * ここを修正
     */
    public function pressButton(Item $item): string
    {
        $price = $item->getPrice();

        if ($item instanceof DepositCupItem) {
            $cupNumber = $item->getCupNumber();
            if ($this->depositedCoin >= $price && $cupNumber > 0) {
                $this->depositedCoin -= $price;
                $item->reduceCup();
                return $item->getName();
            }
        }

        if ($item instanceof DepositItem) {
            $cupNumber = $item->getStockNumber();
            if ($this->depositedCoin >= $price && $cupNumber > 0) {
                $this->depositedCoin -= $price;
                $item->reduceStock();
                return $item->getName();
            }
        }

        return '';
    }
}
