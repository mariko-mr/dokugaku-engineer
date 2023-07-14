<?php

const TAX_RATE = 0.1; // 消費税率10%

/* ここを修正
 * 変数だったのを定数に変更
 */
// 商品番号と金額を含む配列を作成する
const BREAD_PRICES = [
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

/* ここを修正
 * 定数BREAD_PRICESに変更
 */

// [商品番号、税込み価格、販売個数]を配列に格納する [[1, 110, 10], [2, 132, 3],...]
function createBreadSalesRecords(array $inputs): array
{
    $breadSalesRecords = [];

    foreach ($inputs as $input) {
        $productId = $input[0];
        $breadSoldQuantity = (int)$input[1];

        // 税込み価格の計算
        $includedTaxPrice =  BREAD_PRICES[$productId] * (1 + TAX_RATE);

        $breadSalesRecords[] = ['productId' => $productId, 'priceWithTax' => $includedTaxPrice, 'quantity' => $breadSoldQuantity];
    }

    return $breadSalesRecords;
}

// 一日の売上の合計（税込み）を計算する
function calTotalSales(array $breadSalesRecords): int
{
    $totalSales = 0;

    foreach ($breadSalesRecords as $breadSalesRecord) {
        $totalSales += $breadSalesRecord['priceWithTax'] * $breadSalesRecord['quantity'];
    }

    return floor($totalSales);
}

function getMinMaxQuantityId(array $breadSalesRecords, int $sortOrder): array
{
    // 販売個数をもとに$breadSalesRecordsを並び替えする
    $quantities = array_column($breadSalesRecords, 'quantity');
    array_multisort($quantities, $sortOrder, $breadSalesRecords);

    $quantity = $breadSalesRecords[0]['quantity'];
    $quantityIds = [];

    foreach ($breadSalesRecords as $breadSalesRecord) {
        // 最小、もしくは最大の販売個数の商品番号を配列に格納
        if ($breadSalesRecord['quantity'] === $quantity) {
            $quantityIds[] = $breadSalesRecord['productId'];
        }
    }

    return $quantityIds;
}

// アウトプットを出力する
function display(array $breadSalesRecords): void
{
    $totalSales = calTotalSales($breadSalesRecords);                      // 一日の売上の合計（税込み）
    $maxQuantityIds = getMinMaxQuantityId($breadSalesRecords, SORT_DESC); // 販売個数の最も多い商品番号を抽出
    $minQuantityIds = getMinMaxQuantityId($breadSalesRecords, SORT_ASC);  // 販売個数の最も少ない商品番号を抽出

    echo $totalSales . PHP_EOL;

    foreach ($maxQuantityIds as $maxQuantityId) {
        echo $maxQuantityId . ' ';
    }

    echo PHP_EOL;

    foreach ($minQuantityIds as $minQuantityId) {
        echo $minQuantityId . ' ';
    }
}


$inputs = getInput();

/* ここを修正
 * 定数BREAD_PRICESに変更
 */
$breadSalesRecords = createBreadSalesRecords($inputs);

display($breadSalesRecords);



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
