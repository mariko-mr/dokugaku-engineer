<?php

function createWatchingData($input)
{
    // スクリプト名を削除する
    array_shift($input);

    $channelData = [];

    for ($i = 0; $i < count($input); $i += 2) {
        $channel = (int)$input[$i];
        $minutes = (int)$input[$i + 1];

        if (isset($channelData[$channel])) {
            // すでにチャンネルがある場合は視聴時間と回数を更新
            $channelData[$channel]['minutes'] += $minutes;
            $channelData[$channel]['count']++;
        } else {
            // チャンネルが無い場合は新しいチャンネル情報を登録
            $channelData[$channel] = [
                'minutes' => $minutes,
                'count' => 1,
            ];
        }
    }

    ksort($channelData);

    return $channelData;
}

function calWatchingHour($channelData)
{
    $watchingMins = 0;

    foreach ($channelData as $channel => $data) {
        $watchingMins += $data['minutes'];
    }

    $watchingHours = round(($watchingMins / 60), 1);
    echo $watchingHours . PHP_EOL;
}

/* ここを修正
 *
 */
// 視聴チャンネルと視聴時間と回数を出力
function outputWatchingData($channelData)
{
    // $channelData内全ての配列について出力
    foreach ($channelData as $channel => $data) {
        echo $channel . ' ' . $data['minutes'] . ' ' . $data['count'] . PHP_EOL;
    }
}

// コマンドラインの引き数から入力を取得
$input = $argv;

$channelData = createWatchingData($input);
calWatchingHour($channelData);
outputWatchingData($channelData);


// 以下は全てあとで消す
// var_export($channelData);

// docker compose exec app php watching_tv_time.php 1 30 5 25 2 30 1 15

/* アウトプット
 * テレビの合計視聴時間
 * テレビのチャンネル 視聴分数 視聴回数
 * テレビのチャンネル 視聴分数 視聴回数
 */
