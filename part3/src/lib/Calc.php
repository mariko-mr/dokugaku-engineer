<?php

const TAX_RATE = 0.1;     // 消費税率10%
const PRICES = [    // 商品番号 => 金額(税抜)
    1 => 100,  // 玉ねぎ
    2 => 150,  // にんじん
    3 => 200,  // りんご
    4 => 350,  // ぶどう
    5 => 180,  // 牛乳
    6 => 220,  // 玉子
    7 => 440,  // 唐揚げ弁当
    8 => 380,  // のり弁当
    9 => 80,   // お茶
    10 => 100  // コーヒー
];

function calc(string $purchaseTime, array $productNumbers): int
{
    $taxIncludedPayment = 0;
    // 先にディスカウントする


    // 価格に税を含めたものを順番に足していくPRICES[番号]*(1+TAX_RATE)
    foreach ($productNumbers as $productNumber) {
        // お弁当は20〜23時はタイムセールで半額（$purchaseTimeが20〜23時 & 商品番号が7or8）
        $taxIncludedPayment += PRICES[$productNumber] * (1 + TAX_RATE);
    }

    return $taxIncludedPayment;
}

function getDiscount(string $purchaseTime, array $productNumbers)
{
    // 玉ねぎは5つ買うと100円引き（$productNumbersに1が5つ以上あると$taxIncludedPaymentから100円引く）

    // 玉ねぎは3つ買うと50円引き（$productNumbersに1が3つ以上あると$taxIncludedPaymentから50円引く

    // 弁当と飲み物を一緒に買うと20円引き（ただし適用は一組ずつ）

}

calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]);
