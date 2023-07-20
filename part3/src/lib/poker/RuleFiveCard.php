<?php

require_once(__DIR__ . '/../../lib/poker/Rule.php');

class RuleFiveCard implements Rule
{
    public function getHand(array $pokerCards): string
    {
        $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);

        $hand = "high card";

        if ($this->isOnePair($cardRanks)) {
            $hand = "one pair";
        } elseif ($this->isTwoPair($cardRanks)) {
            $hand = "two pair";
        } elseif ($this->isThreeCard($cardRanks)) {
            $hand = "three of a kind";
        } elseif ($this->isStraight($cardRanks)) {
            $hand = "straight";
        } elseif ($this->isFullHouse($cardRanks)) {
            $hand = "full house";
        } elseif ($this->isFourCard($cardRanks)) {
            $hand = "four of a kind";
        }

        return $hand;
    }

    private function isOnePair($cardRanks): bool
    {
        return count(array_unique($cardRanks)) === 4;
    }

    private function isTwoPair($cardRanks): bool
    {
        $countedRanks = $this->countRanks($cardRanks);
        return $countedRanks === [1, 2, 2];
    }

    private function isThreeCard($cardRanks): bool
    {
        $countedRanks = $this->countRanks($cardRanks);
        return $countedRanks === [1, 1, 3];
    }


    private function isStraight($cardRanks): bool
    {
        sort($cardRanks);

        // 数字が連続している場合はストレート
        $range = range(min($cardRanks), max($cardRanks), 1);
        if ($cardRanks === $range) {
            return true;
        }

        // 例外, [1, 2, 3, 4, 13]もストレート
        if ($this->isStraightException($cardRanks)) {
            return true;
        }

        return false;
    }

    private function isFullHouse($cardRanks): bool
    {
        $countedRanks = $this->countRanks($cardRanks);
        return $countedRanks === [2, 3];
    }

    private function isFourCard($cardRanks): bool
    {
        $countedRanks = $this->countRanks($cardRanks);
        return $countedRanks === [1, 4];
    }

    private function countRanks($cardRanks): array
    {
        $counted = array_count_values($cardRanks);
        sort($counted);
        return $counted;
    }

    private function isStraightException($cardRanks): bool
    {
        return $cardRanks === [min(PokerCard::CARD_RANK), min(PokerCard::CARD_RANK) + 1, min(PokerCard::CARD_RANK) + 2, min(PokerCard::CARD_RANK) + 3, max(PokerCard::CARD_RANK)];
    }
}
