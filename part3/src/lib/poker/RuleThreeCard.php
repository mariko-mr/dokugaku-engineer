<?php

namespace Poker;

require_once(__DIR__ . '/../../lib/poker/Rule.php');

class RuleThreeCard implements Rule
{
    private const HIGH_CARD = 'high card';
    private const PAIR = 'pair';
    private const STRAIGHT = 'straight';
    private const THREE_CARD = 'three of a kind';

    private const HAND_RANK = [
        'high card' => 1,
        'pair' => 2,
        'straight' => 3,
        'three of a kind' => 4,
    ];

    public function getHand(array $pokerCards): array
    {
        // [new PokerCard('C2'), new PokerCard('D2'), new PokerCard('D2')] → [1, 1, 1]
        $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);
        sort($cardRanks);

        $hand = self::HIGH_CARD;

        if ($this->isPair($cardRanks)) {
            $hand = self::PAIR;
        } elseif ($this->isStraight($cardRanks)) {
            $hand = self::STRAIGHT;
        } elseif ($this->isThreeCard($cardRanks)) {
            $hand = self::THREE_CARD;
        }

        return [
            'hand_name' => $hand,
            'hand_rank' => self::HAND_RANK[$hand],
            'card_rank_1' => $cardRanks[0],
            'card_rank_2' => $cardRanks[1],
            'card_rank_3' => $cardRanks[2],
        ];
    }

    private function isPair($cardRanks): bool
    {
        return count(array_unique($cardRanks)) === 2;
    }

    private function isStraight($cardRanks): bool
    {
        // 数字が連続している場合はストレート
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

    /**
     * ここを修正
     *
     */
    public function getWinner(string $hand1, string $hand2)
    {
        foreach (['hand_rank', 'card_rank_1', 'card_rank_2', 'card_rank_3'] as $k) {

        }
    }
}
