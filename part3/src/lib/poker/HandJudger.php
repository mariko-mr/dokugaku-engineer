<?php

namespace Poker;

require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

class HandJudger
{
    public function __construct(private Rule $rule)
    {
    }

    public function getHand(array $pokerCards): string
    {
        return $this->rule->getHand($pokerCards);
    }
}
