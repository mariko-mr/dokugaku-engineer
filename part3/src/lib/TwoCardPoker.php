<?php

const PLAYER1 = 1;
const PLAYER2 = 2;
const DRAW = 0;
const CARDS = [
    'HA' => 1, 'H2' => 2, 'H3' => 3, 'H4' => 4, 'H5' => 5, 'H6' => 6,
    'H7' => 7, 'H8' => 8, 'H9' => 9, 'H10' => 10, 'HJ' => 11, 'HQ' => 12, 'HK' => 13,
    'SA' => 1, 'S2' => 2, 'S3' => 3, 'S4' => 4, 'S5' => 5, 'S6' => 6,
    'S7' => 7, 'S8' => 8, 'S9' => 9, 'S10' => 10, 'SJ' => 11, 'SQ' => 12, 'SK' => 13,
    'DA' => 1, 'D2' => 2, 'D3' => 3, 'D4' => 4, 'D5' => 5, 'D6' => 6,
    'D7' => 7, 'D8' => 8, 'D9' => 9, 'D10' => 10, 'DJ' => 11, 'DQ' => 12, 'DK' => 13,
    'CA' => 1, 'C2' => 2, 'C3' => 3, 'C4' => 4, 'C5' => 5, 'C6' => 6,
    'C7' => 7, 'C8' => 8, 'C9' => 9, 'C10' => 10, 'CJ' => 11, 'CQ' => 12, 'CK' => 13
];

function showDown($p1Card1, $p1Card2, $p2Card1, $p2Card2) // ('CK', 'DJ', 'C10', 'H10')
{
    // 引き数を扱いやすい形に直す
    $p1CardNumbers = getCards(array($p1Card1, $p1Card2)); // [13, 11]
    $p2CardNumbers = getCards(array($p2Card1, $p2Card2)); // [10, 10]

    // 役を判定する
    $p1Hand = getHand($p1CardNumbers); // 'high card'
    $p2Hand = getHand($p2CardNumbers); // 'pair'

    // p1とp2どちらが強いか判定する
    $winner = judgeWinner($p1CardNumbers, $p2CardNumbers, $p1Hand, $p2Hand); // PLAYER2

    return [$p1Hand, $p2Hand, $winner]; // p1の役、p2の役、勝利者の番号
}

function getCards(array $cards): array // 'CK', 'DJ' → [13, 11]
{
    $numbers = [];

    foreach ($cards as $card) {
        //定数CARDSからキー'CK'の要素｢13｣を取得
        $numbers[] = CARDS[$card];
    }

    // 強い数字順に並び替える
    // ただしキングとエースの場合は[13, 1]とする
    if (isKingAndAce($numbers)) {
        rsort($numbers, SORT_NUMERIC);
        return $numbers;
    }

    sort($numbers, SORT_NUMERIC);
    return $numbers;
}

function getHand(array $numbers): string // [13, 11] → 'high card'
{
    $hand = "";

    if (isPair($numbers)) {
        $hand = "pair";
        return $hand;
    } elseif (isStraight($numbers)) {
        $hand = "straight";
        return $hand;
    }

    $hand = "high card";
    return $hand;
}

function isPair(array $numbers): bool
{
    return count(array_unique($numbers)) === 1;
}

function isStraight(array $numbers): bool
{
    // 数字が連続している場合はストレート
    // ただしキングとエースの場合[13, 1]もストレート
    if ($numbers[0] + 1 === $numbers[1]) {
        return true;
    } elseif (isKingAndAce($numbers)) {
        return true;
    }

    return false;
}

function isKingAndAce(array $numbers): bool
{
    return in_array(13, $numbers, true) && in_array(1, $numbers, true);
}

function judgeWinner(array $p1CardNumbers, array $p2CardNumbers, string $p1Hand, string $p2Hand): int
{
    $winner = 0;
    $handOrder = [0 => 'high card', 1 => 'pair', 2 => 'straight'];

    // 役の順位を取得
    $p1Rank = array_search($p1Hand, $handOrder); // 0
    $p2Rank = array_search($p2Hand, $handOrder); // 1

    // カードの番号が2枚ともが同じなら引き分け
    if ($p1CardNumbers === $p2CardNumbers) {
        $winner = DRAW;
        return $winner;
    }

    // 手札の役が異なる場合
    if ($p1Rank > $p2Rank) {
        $winner = PLAYER1;
        return $winner;
    }

    if ($p1Rank < $p2Rank) {
        $winner = PLAYER2;
        return $winner;
    }

    // ハイカード対決
    if ($p1Rank === 0 && $p2Rank === 0) {
        // 一番強い数字で勝負
        return determineWinner($p1CardNumbers, $p2CardNumbers, 0);

        // 二番目に強い数字で勝負
        return determineWinner($p1CardNumbers, $p2CardNumbers, 1);
    }

    // ペア対決
    if ($p1Rank === 1 && $p2Rank === 1) {
        // 例外を先に処理。A が最強。
        if (in_array(1, $p1CardNumbers, true)) {
            $winner = PLAYER1;
            return $winner;
        }

        if (in_array(1, $p2CardNumbers, true)) {
            $winner = PLAYER2;
            return $winner;
        }

        // 数字が強いほうが勝ち
        return determineWinner($p1CardNumbers, $p2CardNumbers, 0);
    }

    // ストレート対決
    if ($p1Rank === 2 && $p2Rank === 2) {
        // 例外を先に処理。K-A が最強。
        if (isKingAndAce($p1CardNumbers)) {
            $winner = PLAYER1;
            return $winner;
        }

        if (isKingAndAce($p2CardNumbers)) {
            $winner = PLAYER2;
            return $winner;
        }

        // 一番強い数字を比較する。数字が強いほうが勝ち。
        return determineWinner($p1CardNumbers, $p2CardNumbers, 1);
    }
}

function determineWinner(array $p1CardNumbers, array $p2CardNumbers, int $num): int
{
    $winner = null;

    if ($p1CardNumbers[$num] > $p2CardNumbers[$num]) {
        $winner = PLAYER1;
    } elseif ($p1CardNumbers[$num] < $p2CardNumbers[$num]) {
        $winner = PLAYER2;
    }

    return $winner;
}
