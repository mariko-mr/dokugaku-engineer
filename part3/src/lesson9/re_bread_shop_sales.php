<?php

const SPLIT_LENGTH_TWO = 2;
const TAX_RATE = 0.1;     // 消費税率10%
const BREAD_PRICES = [    // 商品番号 => 金額(税抜)
    1 => 100,
    2 => 120,
    3 => 150,
    4 => 250,
    5 => 80,
    6 => 120,
    7 => 100,
    8 => 180,
    9 => 50,
    10 => 300
];

// コマンドライン引数を扱いやすく処理する
function getInput(): array
{
    $inputs = array_slice($_SERVER['argv'], 1);
    return array_chunk($inputs, SPLIT_LENGTH_TWO);
}

// 商品番号 => 販売個数となる配列をつくる [[1 => 10], ...]
function createBreadSalesRecords(array $inputs): array
{
    $breadSalesRecords = [];

    foreach ($inputs as $input) {
        $productId = $input[0];
        $salesQuantity = $input[1];

        $breadSalesRecords[$productId] = $salesQuantity;
    }

    return $breadSalesRecords;
}

// 一日の売上の合計（税込）を計算する
function calTotalSales(array $breadSalesRecords): int
{
    $totalSales = 0;

    foreach ($breadSalesRecords as $productId => $salesQuantity) {
        $includedTaxPrice = floor(BREAD_PRICES[$productId] * (1 + TAX_RATE));
        $totalSales += $includedTaxPrice * $salesQuantity;
    }

    return $totalSales;
}

// 販売個数の最も多い商品番号を配列にいれる
function getMaxSalesQuantityIds(array $breadSalesRecords): array
{
    $maxSalesQuantity = max(array_values($breadSalesRecords));
    return array_keys($breadSalesRecords, $maxSalesQuantity);
}

// 販売個数の最も少ない商品番号を配列にいれる
function getMinSalesQuantityIds(array $breadSalesRecords): array
{
    $minSalesQuantity = min(array_values($breadSalesRecords));
    return array_keys($breadSalesRecords, $minSalesQuantity);
}

/* ここを修正
 * 戻り値の型を追加
 */
// 結果を出力する
function display(array ...$results): void
{
    foreach ($results as $result) {
        echo implode(" ", $result) . PHP_EOL;
    }
}

$inputs = getInput();
$breadSalesRecords = createBreadSalesRecords($inputs);

$totalSales = calTotalSales($breadSalesRecords);
$maxSalesQuantityIds = getMaxSalesQuantityIds($breadSalesRecords);
$minSalesQuantityIds = getMinSalesQuantityIds($breadSalesRecords);

display([$totalSales], $maxSalesQuantityIds, $minSalesQuantityIds);




/*
インプット
1 10 2 3 5 1 7 5 10 1
販売した商品番号 販売個数 ...
※ただし、販売した商品番号は1〜10の整数とする。

アウトプット
一日の売上の合計（税込み）   2464
販売個数の最も多い商品番号   1
販売個数の最も少ない商品番号 5 10

※ただし、税率は10%とする。
※また、販売個数の最も多い商品と販売個数の最も少ない商品について、
販売個数が同数の商品が存在する場合、それら全ての商品番号を記載すること。

実行コマンド例
docker compose exec app php re_bread_shop_sales.php 1 10 2 3 5 1 7 5 10 1
*/
