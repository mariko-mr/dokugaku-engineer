<?php
class VendingMachine
{
    private const DRINK_PRICE = 100;
    private int $depositedCoin = 0 ;

    public function depositCoin(int $coin): int
    {
        if ($coin === self::DRINK_PRICE) {
            $this->depositedCoin = $coin;
        }
        return $this->depositedCoin;
    }

    public function pressButton(): string
    {
        if ($this->depositedCoin === self::DRINK_PRICE) {
            return 'cider';
        }

        return '';
    }
}
