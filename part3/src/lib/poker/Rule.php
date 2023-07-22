<?php

namespace Poker;
interface Rule
{
    public function getHand(array $pokerCards);
}
