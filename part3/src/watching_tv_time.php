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

function outputWatchingData($channelData)
{
    foreach ($channelData as $channel => $data) {
        echo $channel . ' ' . $data['minutes'] . ' ' . $data['count'] . PHP_EOL;
    }
}

// コマンドラインの引き数から入力を取得
$input = $argv;

$channelData = createWatchingData($input);
calWatchingHour($channelData);
outputWatchingData($channelData);
