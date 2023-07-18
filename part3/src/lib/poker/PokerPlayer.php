<?php

class PokerPlayer
{
    public function __construct(private array $pokerCards)
    {
    }

    public function getRanks(): array
    {
        return array_map(fn ($pokerCard) => $pokerCard->getRank(), $this->pokerCards);
    }
}
