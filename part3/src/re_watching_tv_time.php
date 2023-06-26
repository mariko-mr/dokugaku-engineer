<?php

const SPLIT_BY_TWO = 2;

function getInput()
{
    // コマンドラインの引き数をうけとる
    $inputs = array_slice($_SERVER['argv'], 1);

    // データを扱いやすい配列に直す[[1, 30],[5, 25],...]
    return array_chunk($inputs, SPLIT_BY_TWO);
}

// チャンネル毎に視聴時間をまとめる
function createViewingData(array $channelViewTimes): array
{
    $viewingData = [];  // ['1' => [30, 15], '2' => [30], '5' => [25], $channel => $minutes[$togetherMinutes]]

    foreach ($channelViewTimes as $channelViewTime) {

        $channel = $channelViewTime[0]; // チャンネル番号
        $minutes = $channelViewTime[1]; // 視聴分数
        $togetherMinutes = [$minutes];  // 視聴分数を格納する配列

        if (array_key_exists($channel, $viewingData)) { // すでにチャンネルデータがあれば視聴時間を配列$viewingDataにいれる
            // var_dump($viewingData[$channel]);
            $togetherMinutes = array_merge($viewingData[$channel], $togetherMinutes);
        }

        // 視聴分数を更新
        $viewingData[$channel] = $togetherMinutes;
    }

    ksort($viewingData);
    return $viewingData;
}

$channelViewTimes = getInput();
$viewingData = createViewingData($channelViewTimes);
print_r($viewingData);

// 合計視聴時間を計算する

// テレビのチャンネル 視聴分数 視聴回数を出力する

// 結果を出力する




/* あとで消す
 * docker compose exec app php re_watching_tv_time.php 1 30 5 25 2 30 1 15
 */

/*
アウトプット例
1.7
1 45 2
2 30 1
5 25 1

実行コマンド例
php quiz.php 1 30 5 25 2 30 1 15
 */
