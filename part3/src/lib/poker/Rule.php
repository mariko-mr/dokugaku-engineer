<?php

namespace Poker;
interface Rule
{
    public function getHand(array $pokerCards);

    public function getWinner(string $hand1, string $hand2);
}
