<?php

function createWatchingData($input)
{
    // スクリプト名を削除する
    array_shift($input);

    $channelData = [];
    //$channelData =[ 1=>[45, 2], 2=>[30, 1], 3=>[], 4=>[], 5=>[25, 1] ]

    for ($i = 0; $i < count($input); $i += 2) {
        $channel = (int)$input[$i];
        $minutes = (int)$input[$i + 1];

        if (isset($channelData[$channel])) {
            // すでにチャンネルがある場合は視聴時間と回数を更新
            $channelData[$channel]['minutes'] += $minutes;
            $channelData[$channel]['count']++;
        } else {
            // 新しいチャンネル情報を登録
            $channelData[$channel] = [
                'minutes' => $minutes,
                // countを追加
                'count' => 1,
            ];
        }
    }
    /* ここを修正
     * キーで昇順にソート
     */
    ksort($channelData);

    return $channelData;
}

// 視聴時間を計算する
/* ここを修正
 * 変数名を修正
 */
function calWatchingHour($channelData)
{
    $watchingMins = 0;

    foreach ($channelData as $channel) {
        $watchingMins += $channel['minutes'];
    }

    $watchingHours = round(($watchingMins / 60), 1);
    echo $watchingHours . PHP_EOL;
}

// 視聴channelと視聴時間をまとめる
function outputWatchingData($channelData)
{
    // foreach ($watchingData as $channelData) {
    //     echo array_count_values($channelData);
    // }


    // 1~12chについて視聴時間と視聴回数を出力する
    for ($channel = 1; $channel <= 12; $channel++) {
        // 回数が0の場合は飛ばす

        // 回数が1以上の場合は出力する
        echo $channel . PHP_EOL;
    }
}

// コマンドラインの引き数から入力を取得
$input = $argv;
$channelData = createWatchingData($input);
calWatchingHour($channelData);
// outputWatchingData($watchingData);

var_export($channelData);

// docker compose exec app php watching_tv_time.php 1 30 5 25 2 30 1 15

/* アウトプット
 * テレビの合計視聴時間
 * テレビのチャンネル 視聴分数 視聴回数
 * テレビのチャンネル 視聴分数 視聴回数
 */
