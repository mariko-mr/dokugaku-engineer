<?php

require_once(__DIR__ . '/../../lib/poker/Rule.php');

class RuleThreeCard extends Rule
{
    public function getHand(array $pokerCards): string
    {
        // [new PokerCard('C2'), new PokerCard('D2'), new PokerCard('D2')] → [1, 1, 1]
        $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);

        $hand = "high card";

        if ($this->isPair($cardRanks)) {
            $hand = "pair";
        } elseif ($this->isStraight($cardRanks)) {
            $hand = "straight";
        } elseif ($this->isThreeCard($cardRanks)) {
            $hand = "three of a kind";
        }

        return $hand;
    }

    private function isPair($cardRanks): bool
    {
        return count(array_unique($cardRanks)) === 2;
    }

    private function isStraight($cardRanks): bool
    {
        // 数字が連続している場合はストレート
        sort($cardRanks);
        $range = range(min($cardRanks), max($cardRanks), 1);
        if ($cardRanks === $range) {
            return true;
        }

        // 例外, [1, 2, 13]もストレート
        if ($this->isMinMax($cardRanks)) {
            return true;
        }

        return false;
    }

    private function isThreeCard($cardRanks): bool
    {
        return count(array_unique($cardRanks)) === 1;
    }

    private function isMinMax($cardRanks): bool
    {
        return $cardRanks === [min(PokerCard::CARD_RANK), min(PokerCard::CARD_RANK) + 1, max(PokerCard::CARD_RANK)];
    }
}
