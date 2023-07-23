<?php

namespace Poker;
interface Rule
{
    public function getHand(array $pokerCards);

    public function getWinner(array $hand1, array $hand2);
}
