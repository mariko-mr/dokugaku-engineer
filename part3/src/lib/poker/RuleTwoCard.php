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

    private const PLAYER1 = 1;
    private const PLAYER2 = 2;
    private const DRAW = 0;

    public function getHand(array $pokerCards): array
    {
        // [new PokerCard('CA'), new PokerCard('DA')] → [13, 13]
        $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);
        rsort($cardRanks);

        $hand = self::HIGH_CARD;

        if ($this->isPair($cardRanks[0], $cardRanks[1])) {
            $hand = self::PAIR;;
        }

        if ($this->isStraight($cardRanks[0], $cardRanks[1])) {
            $hand = self::STRAIGHT;
            if ($this->isMinMax($cardRanks[0], $cardRanks[1])) {
                sort($cardRanks);
            }
        }

        return [
            'hand_name' => $hand,
            'hand_rank' => self::HAND_RANK[$hand],
            'card_rank_1' => $cardRanks[0],
            'card_rank_2' => $cardRanks[1],
        ];
    }

    private function isPair($rank1, $rank2): bool
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
    public function getWinner(array $hand1, array $hand2): int
    {
        foreach (['hand_rank', 'card_rank_1', 'card_rank_2'] as $k) {
            if ($hand1[$k] > $hand2[$k]) {
                return self::PLAYER1;
            }

            if ($hand1[$k] < $hand2[$k]) {
                return self::PLAYER2;
            }
        }

        return self::DRAW;
    }
}
