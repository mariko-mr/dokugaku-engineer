<?php

const TAX_RATE = 0.1; // 消費税率10%

// 商品番号と金額を含む配列を作成する
$breadPrices = [
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

// コマンドラインから引き数をとってくる
function getInput(): array
{
    $inputs = array_slice($_SERVER['argv'], 1);
    // インプットされたものを２つにわける[[1, 10],[2, 3],...]
    return array_chunk($inputs, 2);
}


// 商品番号をキーとして価格と個数を格納する[1 => [100, 10],2 => [120, 3],...]
function createBreadSalesRecords(array $inputs, $breadPrices): array
{
    $BreadSalesRecords = [];

    foreach ($inputs as $input) {
        $productId = $input[0];
        $breadSoldQuantity = (int)$input[1];

        $includedTaxPrice = $breadPrices[$productId] * (1 + TAX_RATE);

        $BreadSalesRecords[$productId] = ['priceWithTax' => $includedTaxPrice, 'quantity' => $breadSoldQuantity];
    }

    return $BreadSalesRecords;
}

// 一日の売上の合計（税込み）を計算する
function calTotalSales(array $BreadSalesRecords): int
{
    $totalSales = 0;

    foreach ($BreadSalesRecords as $BreadSalesRecord) {
        $totalSales += $BreadSalesRecord['priceWithTax'] * $BreadSalesRecord['quantity'];
    }

    return floor($totalSales);
}

function getMaxQuantityId(array $BreadSalesRecords): array
{
    $maxQuantity = 0;
    $maxQuantityIds = [];

    foreach ($BreadSalesRecords as $id => $BreadSalesRecord) {
        // 販売個数が多ければ商品番号を更新
        if ($BreadSalesRecord['quantity'] >= $maxQuantity) {
            $maxQuantity = $BreadSalesRecord['quantity'];
            $maxQuantityIds[] = $id;
        }
    }

    return $maxQuantityIds;
}

function getMinQuantityId(array $BreadSalesRecords): array
{
    $minQuantity = PHP_INT_MAX;
    $minQuantityIds = [];

    foreach ($BreadSalesRecords as $id => $BreadSalesRecord) {
        // 販売個数が少なければ商品番号を更新
        if ($BreadSalesRecord['quantity'] <= $minQuantity) {
            $minQuantity = $BreadSalesRecord['quantity'];
            $minQuantityIds[] = $id;
        }
    }

    return $minQuantityIds;
}

// アウトプットを出力する
function display(array $BreadSalesRecords): void
{
    $totalSales = calTotalSales($BreadSalesRecords); // 一日の売上の合計（税込み）
    $maxQuantityIds = getMaxQuantityId($BreadSalesRecords); // 販売個数の最も多い商品番号を抽出する
    $minQuantityIds = getMinQuantityId($BreadSalesRecords); // 販売個数の最も少ない商品番号を抽出する

    echo $totalSales . PHP_EOL;

    foreach ($maxQuantityIds as $maxQuantityId) {
        echo $maxQuantityId . PHP_EOL;
    }

    foreach ($minQuantityIds as $minQuantityId) {
        echo $minQuantityId . PHP_EOL;
    }
}


$inputs = getInput();
// print_r($inputs);

$BreadSalesRecords = createBreadSalesRecords($inputs, $breadPrices);
// print_r($BreadSalesRecords);

display($BreadSalesRecords);



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
docker compose exec app php bread_shop_sales.php 1 10 2 3 5 1 7 5 10 1
*/