<?php

require_once(__DIR__ . '/../../lib/vending_machine/Item.php');
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

    public function pressButton(Item $item): string
    {
        if ($this->depositedCoin >= $item->getPrice()) {
            return $item->getName();
        }

        return '';
    }
}
