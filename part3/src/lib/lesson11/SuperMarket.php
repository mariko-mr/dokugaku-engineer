<?php

const ONION_COUNT_THREE = 3;
const ONION_COUNT_FIVE = 5;
const ONION_DISCOUNT_THREE = 50;
const ONION_DISCOUNT_FIVE = 100;

const SET_DISCOUNT = 20;
const HALF_PRICE = 0.5;

const TAX_RATE = 0.1;      // 消費税率10%
const PRICES = [           // 商品番号 => []
    1 => ['price' => 100, 'type' => ''],         // 玉ねぎ
    2 => ['price' => 150, 'type' => ''],         // にんじん
    3 => ['price' => 200, 'type' => ''],         // りんご
    4 => ['price' => 350, 'type' => ''],         // ぶどう
    5 => ['price' => 180, 'type' => 'drink'],    // 牛乳
    6 => ['price' => 220, 'type' => ''],         // 玉子
    7 => ['price' => 440, 'type' => 'lunchBox'], // 唐揚げ弁当
    8 => ['price' => 380, 'type' => 'lunchBox'], // のり弁当
    9 => ['price' => 80, 'type' => 'drink'],     // お茶
    10 => ['price' => 100, 'type' => 'drink']    // コーヒー
];

/**
 * @param array<int, string | int> $productIds
 */
function calc(string $purchaseTime, array $productIds): int
{
    $pay = 0;

    // 価格に税を含めたものを順番に足していく
    foreach ($productIds as $productId) {
        $pay += PRICES[$productId]['price'];
    }

    // ディスカウントする
    $count = array_count_values($productIds);
    $pay -= discountOnion($count);
    $pay -= discountSet($count);
    $pay -= discountLunchBox($purchaseTime, $productIds);

    // ここで税込み計算をする
    return (int)($pay * (1 + TAX_RATE));
}

/**
 * @param array<int, string | int> $count
 */
function discountOnion(array $count): int
{
    $onion = $count[1];
    $discountOnion = 0;

    if ($onion >= ONION_COUNT_FIVE) {           // 玉ねぎは5つ買うと100円引き
        $discountOnion += ONION_DISCOUNT_FIVE;
    } elseif ($onion >= ONION_COUNT_THREE) {    // 玉ねぎは3つ買うと50円引き
        $discountOnion += ONION_DISCOUNT_THREE;
    }

    return $discountOnion;
}

/**
 * @param array<int, string | int> $count
 */
// 弁当と飲み物を一緒に買うと20円引き（ただし適用は一組ずつ）
function discountSet(array $count): int
{
    // ドリンクの数、弁当の数を取得
    $lunchBox = $count[7] + $count[8];
    $drink = $count[5] + $count[9] + $count[10];

    $discountSet = 0;

    for ($i = 0; $i < $lunchBox && $i < $drink; $i++) {
        $discountSet += SET_DISCOUNT;
    }

    return $discountSet;
}

/* ここを修正
 * ifの中をブール関数に置き換え
 */
/**
 * @param array<int, string | int> $productIds
 */
// お弁当は20〜23時はタイムセールで半額
function discountLunchBox(string $purchaseTime, array $productIds): int
{
    $discountLunchBox = 0;

    if (isDiscountTime($purchaseTime)) {
        foreach ($productIds as $productId) {
            if (PRICES[$productId]['type'] === 'lunchBox') {
                $discountLunchBox += PRICES[$productId]['price'] * HALF_PRICE;
            }
        }
    }

    return $discountLunchBox;
}

/* ここを修正
 * ヘルパー関数を追加
 */
function isDiscountTime(string $purchaseTime): bool
{
    $startTime = date('20:00');
    $endTime = date('23:59');
    $purchaseTime = date($purchaseTime);

    return $startTime <= $purchaseTime && $purchaseTime <= $endTime;
}
