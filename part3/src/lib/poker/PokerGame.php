<?php

class PokerGame
{
    public function __construct(private array $cards)
    {
    }

    public function pokerStart(): array
    {
        return $this->cards;
    }
}
