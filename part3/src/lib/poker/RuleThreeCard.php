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

    private const PLAYER1 = 1;
    private const PLAYER2 = 2;
    private const DRAW = 0;

    public function getHand(array $pokerCards): array
    {
        // [new PokerCard('C3'), new PokerCard('DA'), new PokerCard('D2')] → [13, 2, 1]
        $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);
        rsort($cardRanks);

        $hand = self::HIGH_CARD;

        if ($this->isPair($cardRanks)) {
            $hand = self::PAIR;
        } elseif ($this->isStraight($cardRanks)) {
            $hand = self::STRAIGHT;
            if ($this->isMinMax($cardRanks)) { // A-2-3 の組み合わせの場合、3 を一番強い数字とする
                $cardRanks = [2, 1, 13];
            }
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
        $range = range(max($cardRanks), min($cardRanks), 1);
        if ($cardRanks === $range) {
            return true;
        }

        // 例外, [13, 2, 1]もストレート
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
        return $cardRanks === [max(PokerCard::CARD_RANK), min(PokerCard::CARD_RANK) + 1, min(PokerCard::CARD_RANK)];
    }

    /**
     * ここを修正
     *
     */
    public function getWinner(array $hand1, array $hand2): int
    {
        $ranks1 = [$hand1['card_rank_1'], $hand1['card_rank_2'], $hand1['card_rank_3']];
        $ranks2 = [$hand2['card_rank_1'], $hand2['card_rank_2'], $hand2['card_rank_3']];
        // ペア対決
        if ($hand1['hand_rank'] === 2 && $hand2['hand_rank'] === 2) {
            return $this->comparePair($ranks1, $ranks2);
        }

        return $this->isStronger($hand1, $hand2);
    }

    private function isStronger($hand1, $hand2): int
    {
        foreach (['hand_rank', 'card_rank_1', 'card_rank_2', 'card_rank_3'] as $k) {
            if ($hand1[$k] > $hand2[$k]) {
                return self::PLAYER1;
            }

            if ($hand1[$k] < $hand2[$k]) {
                return self::PLAYER2;
            }
        }

        return self::DRAW;
    }

    private function comparePair(array $rank1, array $rank2): int
    {
        // ペアの数字同士のランクを比較
        $pairRank1 = array_keys(array_count_values($rank1), 2);
        $pairRank2 = array_keys(array_count_values($rank2), 2);
        if ($pairRank1 > $pairRank2) {
            return self::PLAYER1;
        } elseif ($pairRank1 < $pairRank2) {
            return self::PLAYER2;
        }

        // ペアではない3枚目同士のランクを比較
        $notPair1 = array_keys(array_count_values($rank1), 1);
        $notPair2 = array_keys(array_count_values($rank2), 1);
        if ($notPair1 > $notPair2) {
            return self::PLAYER1;
        } elseif ($notPair1 < $notPair2) {
            return self::PLAYER2;
        }

        return self::DRAW;
    }
}
