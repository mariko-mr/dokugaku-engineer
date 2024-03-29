<?php

namespace Poker;

require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

class HandJudger
{
    public function __construct(private Rule $rule)
    {
    }

    public function getHand(array $pokerCards): array
    {
        return $this->rule->getHand($pokerCards);
    }

    public function getWinner(array $hand1, array $hand2): int
    {
        return $this->rule->getWinner($hand1, $hand2);
    }
}
