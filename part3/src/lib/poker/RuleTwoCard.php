<?php

namespace Poker;

require_once(__DIR__ . '/../../lib/poker/Rule.php');

class RuleTwoCard implements Rule
{
    private const HIGH_CARD = 'high card';
    private const PAIR = 'pair';
    private const STRAIGHT = 'straight';

    private const HAND_RANK = [
        'high card' => 1,
        'pair' => 2,
        'straight' => 3,
    ];

    public function getHand(array $pokerCards): array
    {
        // [new PokerCard('CA'), new PokerCard('DA')] → [13, 13]
        $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);
        rsort($cardRanks);

        $hand = self::HIGH_CARD;

        if ($this->isPair($cardRanks[0], $cardRanks[1])) {
            $hand = self::PAIR;;
        } elseif ($this->isStraight($cardRanks[0], $cardRanks[1])) {
            $hand = self::STRAIGHT;
        }

        return [
            'hand_name' => $hand,
            'hand_rank' => self::HAND_RANK[$hand],
            'card_rank_1' => $cardRanks[0],
            'card_rank_2' => $cardRanks[1],
        ];
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

    /**
     * ここを修正
     *
     */
    public function getWinner(string $hand1, string $hand2)
    {
        foreach (['hand_rank', 'card_rank_1', 'card_rank_2'] as $k) {
            if ($hand1[$k] > $hand2[$k]) {
                return 1;
            }

            if ($hand1[$k] < $hand2[$k]) {
                return 2;
            }
        }
    }
}
