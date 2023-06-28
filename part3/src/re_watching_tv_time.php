<?php

/* ここを修正
 * 定数MINUTES_PER_HOURの追加
 */
const SPLIT_BY_TWO = 2;
const MINUTES_PER_HOUR = 60;

function getInput()
{
    $inputs = array_slice($_SERVER['argv'], 1);

    // データを扱いやすい配列に直す[[1, 30],[5, 25],...]
    return array_chunk($inputs, SPLIT_BY_TWO);
}

function createViewingData(array $inputs): array
{
    $viewingData = [];  // [$channel => $togetherMinutes]

    foreach ($inputs as $input) {

        $channel = $input[0]; // チャンネル番号
        $minutes = $input[1]; // 視聴分数
        $togetherMinutes = [$minutes];  // 視聴分数を格納する配列

        if (array_key_exists($channel, $viewingData)) {
            $togetherMinutes = [...$viewingData[$channel], ...$togetherMinutes];
        }

        // 視聴分数を更新
        $viewingData[$channel] = $togetherMinutes;
    }

    ksort($viewingData);
    return $viewingData;
}

/* ここを修正
 * 視聴時間の計算を追加
 */
function calTotalViewingHours($viewingData)
{
    $totalViewingTimes = array_sum(array_merge(...$viewingData));
    $totalViewingHours = round(($totalViewingTimes/MINUTES_PER_HOUR), 1);

    return $totalViewingHours;
}

// 結果を出力する
function display(array $viewingData)
{
    $totalViewingHours = calTotalViewingHours($viewingData);
    echo $totalViewingHours;
}


$inputs = getInput();
$viewingData = createViewingData($inputs);
display($viewingData);


/* あとで消す
docker compose exec app php re_watching_tv_time.php 1 30 5 25 2 30 1 15

 アウトプット例
 1.7
 1 45 2
 2 30 1
 5 25 1
 */
