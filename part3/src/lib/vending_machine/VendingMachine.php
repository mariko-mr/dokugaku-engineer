<?php

require_once(__DIR__ . '/../../lib/vending_machine/Item.php');
require_once(__DIR__ . '/../../lib/vending_machine/Drink.php');
require_once(__DIR__ . '/../../lib/vending_machine/CupDrink.php');
require_once(__DIR__ . '/../../lib/vending_machine/Snack.php');

class VendingMachine
{
    private int $depositedCoin = 0;
    private int $cup = 0;
    private const COIN = 100;
    private const MAX_CUP = 100;

    public function depositCoin(int $coin): int
    {
        if ($coin === self::COIN) {
            $this->depositedCoin += $coin;
        }
        return $this->depositedCoin;
    }

    public function addCup(int $cupNumber): int
    {
        if (($this->cup + $cupNumber) > self::MAX_CUP) {
            $this->cup = self::MAX_CUP;
            return $this->cup;
        }

        return $this->cup += $cupNumber;
    }

    public function pressButton(Item $item): string
    {
        $price = $item->getPrice();
        $cupNumber = $item->getCupNumber();

        if ($this->depositedCoin >= $price && $this->cup >= $cupNumber) {
            $this->depositedCoin -= $price;
            $this->cup -= $cupNumber;
            return $item->getName();
        }

        return '';
    }
}
