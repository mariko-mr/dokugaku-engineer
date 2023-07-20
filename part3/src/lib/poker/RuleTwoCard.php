<?php

require_once(__DIR__ . '/../../lib/poker/Rule.php');

class RuleTwoCard implements Rule
{
    public function getHand(array $pokerCards): string
    {
        // [new PokerCard('CA'), new PokerCard('DA')] → [13, 13]
        $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);

        $hand = "high card";

        if ($this->isPair($cardRanks[0], $cardRanks[1])) {
            $hand = "pair";
            return $hand;
        } elseif ($this->isStraight($cardRanks[0], $cardRanks[1])) {
            $hand = "straight";
            return $hand;
        }

        return $hand;
    }

    public function isPair($rank1, $rank2): bool
    {
        return $rank1 === $rank2;
    }

    private function isStraight($rank1, $rank2): bool
    {
        return abs($rank1 - $rank2) === 1 || $this->isMinMax($rank1, $rank2);
    }

    private function isMinMax($rank1, $rank2): bool
    {
        return abs($rank1 - $rank2) === (max(PokerCard::CARD_RANK) - min(PokerCard::CARD_RANK));
    }
}
