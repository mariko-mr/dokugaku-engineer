<?php

require_once(__DIR__ . '/../../lib/vending_machine/Drink.php');
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

    public function pressButton(Drink $drink): string
    {
        $price = $drink->getPrice();
        if ($this->depositedCoin >= $price) {
            $this->depositedCoin -= $price;
            return $drink->getName();
        }

        return '';
    }
}
