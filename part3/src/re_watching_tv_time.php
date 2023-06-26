<?php

const SPLIT_BY_TWO = 2;

function getInput()
{
    $inputs = array_slice($_SERVER['argv'], 1);

    // データを扱いやすい配列に直す[[1, 30],[5, 25],...]
    return array_chunk($inputs, SPLIT_BY_TWO);
}

/* ここを修正
 * 変数名を変更
 */
function createViewingData(array $inputs): array
{
    $viewingData = [];  // ['1' => [30, 15], '2' => [30], '5' => [25], $channel => $minutes[$togetherMinutes]]

    foreach ($inputs as $input) {

        $channel = $input[0]; // チャンネル番号
        $minutes = $input[1]; // 視聴分数
        $togetherMinutes = [$minutes];  // 視聴分数を格納する配列

        if (array_key_exists($channel, $viewingData)) {
            $togetherMinutes = array_merge($viewingData[$channel], $togetherMinutes);
        }

        // 視聴分数を更新
        $viewingData[$channel] = $togetherMinutes;
    }

    ksort($viewingData);
    return $viewingData;
}

// 合計視聴時間を計算する
function calTotalViewingTimes(){

}

// 結果を出力する
function display(array $viewingData){

}

/* ここを修正
 * 変数名を変更
 */
$inputs = getInput();
$viewingData = createViewingData($inputs);
display($viewingData);
// print_r($viewingData);


/* あとで消す
docker compose exec app php re_watching_tv_time.php 1 30 5 25 2 30 1 15

 アウトプット例
 1.7
 1 45 2
 2 30 1
 5 25 1
 */
