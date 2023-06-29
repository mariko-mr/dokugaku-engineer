<?php
const TAX_LATE = 0.1;     // 消費税率10%
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
function getInput(){

}

// 商品番号 => 販売個数[[1 => 10], ...]となる配列をつくる
function createBreadSalesRecords($inputs){

}

// 一日の売上の合計（税込）を計算する
function calTotalSales(){

}

// 販売個数の最も多い商品番号を配列にいれる

// 販売個数の最も少ない商品番号を配列にいれる

// 結果を出力する
function display(...$result){

}


$inputs = getInput();
$breadSalesRecords = createBreadSalesRecords($inputs);
// display($total, $max, $min);




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
