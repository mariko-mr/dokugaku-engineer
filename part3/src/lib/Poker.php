<?php

const PLAYER1 = 1;
const PLAYER2 = 2;
const COUNT_PLAYER = 2;
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

/**
 * @return array<int,string|int>
 */
function showDown(string ...$playerCards): array
{
    // 引き数を扱いやすい形に直す
    $chunkedNumbers = getCards($playerCards);
    $p1CardNumbers = (array) $chunkedNumbers[0];
    $p2CardNumbers = (array) $chunkedNumbers[1];

    // 役を判定する
    $p1Hand = getHand($p1CardNumbers); // 'high card'
    $p2Hand = getHand($p2CardNumbers); // 'pair'

    // p1とp2どちらが強いか判定する
    $winner = judgeWinner($p1CardNumbers, $p2CardNumbers, $p1Hand, $p2Hand); // PLAYER2

    return [$p1Hand, $p2Hand, $winner]; // p1の役、p2の役、勝利者の番号
}

/**
 * @param array<int,string> $cards
 * @return array<int,int>
 */
function getCards(array $cards): array // 'CK', 'DJ', 'H9', 'C10', 'H10', 'D10' → [13, 11, 9][10, 10, 10]
{
    // 整数型に変換
    $numbers = [];
    foreach ($cards as $card) {
        $numbers[] = CARDS[$card];
    }

    // プレイヤー毎にカードを分割する
    $chunkedNumbers = array_chunk($numbers, count($numbers) / COUNT_PLAYER);

    for ($i = 0; $i < COUNT_PLAYER; $i++) {
        rsort($chunkedNumbers[$i], SORT_NUMERIC);
    }

    return $chunkedNumbers;
}

/**
 * @param array<int,int> $numbers
 */
function getHand(array $numbers): string
{
    $hand = "";

    if (isThree($numbers)) {
        $hand = "three card";
        return $hand;
    } elseif (isPair($numbers)) {
        $hand = "pair";
        return $hand;
    } elseif (isStraight($numbers)) {
        $hand = "straight";
        return $hand;
    }

    $hand = "high card";
    return $hand;
}

/**
 * @param array<int,int> $numbers
 */
function isThree(array $numbers): bool
{
    if (count($numbers) === 3) {
        return count(array_unique($numbers)) === 1;
    }

    return false;
}

/**
 * @param array<int,int> $numbers
 */
function isPair(array $numbers): bool
{
    // カードが2枚の場合
    if (count($numbers) === 2) {
        return count(array_unique($numbers)) === 1;
    }
    // カードが3枚の場合
    return count(array_unique($numbers)) === 2;
}

/**
 * @param array<int,int> $numbers
 */
function isStraight(array $numbers): bool
{
    // 数字が連続している場合はストレート
    $max = max($numbers);
    $min = min($numbers);
    $range = range($max, $min, 1);

    if ($numbers === $range) {
        return true;
    }

    // ただし, [13, 12 , 1]もストレート
    if (count($numbers) === 3 && isQKA($numbers)) {
        return true;
    }

    // ただし, [13, 1]もストレート
    if (count($numbers) === 2 && isKingAndAce($numbers)) {
        return true;
    }

    return false;
}

/**
 * @param array<int,int> $numbers
 */
function isKingAndAce(array $numbers): bool
{
    return in_array(13, $numbers, true) && in_array(1, $numbers, true);
}

/**
 * @param array<int,int> $numbers
 */
function isQKA(array $numbers): bool
{
    $qka = [13, 12, 1];
    return $numbers === $qka;
}

/**
 * @param array<int,int> $p1CardNumbers
 * @param array<int,int> $p2CardNumbers
 */
function judgeWinner(array $p1CardNumbers, array $p2CardNumbers, string $p1Hand, string $p2Hand): int
{
    $handOrder = [0 => 'high card', 1 => 'pair', 2 => 'straight', 3 => 'three card'];

    // 役の順位を取得
    $p1HandRank = [];
    $p2HandRank = [];
    $p1HandRank['rank'] = array_search($p1Hand, $handOrder); // 0
    $p2HandRank['rank'] = array_search($p2Hand, $handOrder); // 1

    // カードが全て同じ数字の場合
    if ($p1CardNumbers === $p2CardNumbers) {
        return DRAW;
    }

    // 手札の役が異なる場合
    if ($p1HandRank !== $p2HandRank) {
        return isStronger($p1HandRank, $p2HandRank, 'rank');
    }

    // ハイカード対決
    if ($p1HandRank['rank'] === 0 && $p2HandRank['rank'] === 0) {
        return compareHighCard($p1CardNumbers, $p2CardNumbers);
    }

    // ペア対決
    if ($p1HandRank['rank'] === 1 && $p2HandRank['rank'] === 1) {
        return comparePair($p1CardNumbers, $p2CardNumbers);
    }

    // ストレート対決
    if ($p1HandRank['rank'] === 2 && $p2HandRank['rank'] === 2) {
        return compareStraight($p1CardNumbers, $p2CardNumbers);
    }

    // スリーカード対決
    if ($p1HandRank['rank'] === 3 && $p2HandRank['rank'] === 3) {
        return compareThreeCard($p1CardNumbers, $p2CardNumbers);
    }
}

/**
 * @param array<int,int> $p1CardNumbers
 * @param array<int,int> $p2CardNumbers
 */
function compareHighCard(array $p1CardNumbers, array $p2CardNumbers): int
{
    // 例外を先に処理。1 をもっていれば勝ち
    if (in_array(1, $p1CardNumbers, true)) {
        return PLAYER1;
    } elseif (in_array(1, $p2CardNumbers, true)) {
        return PLAYER2;
    }

    $countCards = count($p1CardNumbers);
    // 一番強い数字同士を比較する
    for ($i = 0; $i < $countCards; $i++) {
        if ($p1CardNumbers[$i] !== $p2CardNumbers[$i]) {
            return isStronger($p1CardNumbers, $p2CardNumbers, $i);
        }
    }
}

/**
 * @param array<int,int> $p1CardNumbers
 * @param array<int,int> $p2CardNumbers
 */
function comparePair(array $p1CardNumbers, array $p2CardNumbers): int
{
    // ペアの数字同士のランクを比較
    $p1PairNumber = array_keys(array_count_values($p1CardNumbers), 2);
    $p2PairNumber = array_keys(array_count_values($p2CardNumbers), 2);

    if ($p1PairNumber !== $p2PairNumber) {
        // 例外を先に処理。[1, 1] を持っているプレイヤーが勝ち
        if ($p1PairNumber[0] === 1) {
            return PLAYER1;
        } elseif ($p2PairNumber[0] === 1) {
            return PLAYER2;
        }
        // 強い数字のペアの勝ち
        return isStronger($p1PairNumber, $p2PairNumber, 0);
    }

    // ペアではない3枚目同士のランクを比較
    $p1NotPair = array_keys(array_count_values($p1CardNumbers), 1);
    $p2NotPair = array_keys(array_count_values($p2CardNumbers), 1);
    return isStronger($p1NotPair, $p2NotPair, 0);
}

/**
 * @param array<int,int> $p1CardNumbers
 * @param array<int,int> $p2CardNumbers
 */
function compareStraight(array $p1CardNumbers, array $p2CardNumbers): int
{
    // [13, ..., 1]を持っていれば最強
    if (isKingAndAce($p1CardNumbers)) {
        return PLAYER1;
    } elseif (isKingAndAce($p2CardNumbers)) {
        return PLAYER2;
    }

    // 一番強い数字を比較する。数字が強いほうが勝ち。
    return isStronger($p1CardNumbers, $p2CardNumbers, 0);
}

/**
 * @param array<int,int> $p1CardNumbers
 * @param array<int,int> $p2CardNumbers
 */
function compareThreeCard(array $p1CardNumbers, array $p2CardNumbers): int
{
    // 例外を先に処理。1 をもっていれば勝ち
    if (in_array(1, $p1CardNumbers, true)) {
        return PLAYER1;
    } elseif (in_array(1, $p2CardNumbers, true)) {
        return PLAYER2;
    }

    // 一番強い数字を比較する。数字が強いほうが勝ち。
    return isStronger($p1CardNumbers, $p2CardNumbers, 0);
}

/**
 * @param array<string|int,int> $player1
 * @param array<string|int,int> $player2
 */
function isStronger(array $player1, array $player2, int|string $key): int
{
    if ($player1[$key] > $player2[$key]) {
        return PLAYER1;
    } elseif ($player1[$key] < $player2[$key]) {
        return PLAYER2;
    }
}
