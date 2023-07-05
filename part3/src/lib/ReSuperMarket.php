<?php

const ONION_FIVE = 5;
const ONION_THREE = 3;
const ONION_FIVE_DC = 100;
const ONION_THREE_DC = 50;
const SET_DC = 20;
const HALF = 0.5;
const RATE_OF_TAX = 0.1;
const ITEMS = [
    1 => ['price' => 100, 'type' => 'onion'],  // 玉ねぎ
    2 => ['price' => 150, 'type' => ''],       // 人参
    3 => ['price' => 200, 'type' => ''],       // りんご
    4 => ['price' => 350, 'type' => ''],       // ぶどう
    5 => ['price' => 180, 'type' => 'drink'],  // 牛乳
    6 => ['price' => 220, 'type' => ''],       // 卵
    7 => ['price' => 440, 'type' => 'bento'],  // 唐揚げ弁当
    8 => ['price' => 380, 'type' => 'bento'],  // のり弁
    9 => ['price' => 80, 'type' => 'drink'],   // お茶
    10 => ['price' => 100, 'type' => 'drink'], // コーヒー
];

/**
 * @param array<string, int> $items
 */
function reCalc(string $time, array $items): int
{
    $total = 0;
    foreach ($items as $item) {
        $total += ITEMS[$item]['price'];
    }

    // 合計金額から割引額を引く
    $total -= totalDc($time, $items);

    // 税込み合計金額を返す
    return calTaxInPrice($total);
}

/**
 * @param array<string, int> $items
 */
function getCount(array $items, string $type): int
{
    $count = 0;
    foreach ($items as $item) {
        if (ITEMS[$item]['type'] === $type) {
            $count++;
        }
    }

    return $count;
}

/**
 * @param array<string, int> $items
 */
function dcOnion(array $items): int
{
    $onion = getCount($items, 'onion');
    $dcOnion = 0;

    if ($onion >= ONION_FIVE) {       // 玉ねぎ5つで100円引き
        $dcOnion += ONION_FIVE_DC;
    } elseif ($onion >= ONION_THREE) { // 玉ねぎ3つで50円引き
        $dcOnion += ONION_THREE_DC;
    }

    return $dcOnion;
}

/**
 * @param array<string, int> $items
 */
function dcSet(array $items): int
{
    $bento = getCount($items, 'bento');
    $drink = getCount($items, 'drink');
    $dcSet = 0;

    // $bentoと$drinkの最小値×20円を割引する
    $dcSet = min($bento, $drink) * SET_DC;

    return $dcSet;
}

/**
 * @param array<string, int> $items
 */
function dcTimeSale(string $time, array $items): int
{
    $startTime = date('20:00');
    $endTime = date('23:59');
    $purchaseTime = date($time);
    $dcTimeSale = 0;

    if ($startTime <= $purchaseTime && $purchaseTime <= $endTime) { // $timeが20～23時の場合
        foreach ($items as $item) {
            if (ITEMS[$item]['type'] === 'bento') { // お弁当なら半額を足していく
                $dcTimeSale += ITEMS[$item]['price'] * HALF;
            }
        }
    }

    return $dcTimeSale;
}

/**
 * @param array<string, int> $items
 */
function totalDc(string $time, array $items): int
{
    //ディスカウントをまとめる
    $totalDc = 0;
    $totalDc += dcOnion($items);
    $totalDc += dcSet($items);
    $totalDc += dcTimeSale($time, $items);

    return $totalDc;
}

function calTaxInPrice(int $total): int
{
    return (int)($total * (1 + TAX));
}
