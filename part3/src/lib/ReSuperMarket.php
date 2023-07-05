<?php

const RATE_OF_TAX = 0.1;

const ITEMS = [
    1 => ['price' => 100, 'type' => ''],       // 玉ねぎ
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

function reCalc(string $time, array $items): int
{

    $total = 0 ;
    // それぞれの商品価格を$totalに入れる
    foreach($items as $item){
        $total += ITEMS[$item]['price'];
    }

    // 税込み合計金額を返す
    return $total;
}
