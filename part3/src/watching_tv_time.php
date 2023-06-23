<?php

// バリデーション処理する
function validated($channel, $minutes)
{
    $validated = [];
    // チャンネル
    if ($channel < 1 || $channel > 12) {
        $validated[] = 'チャンネルは1〜12の範囲(1ch〜12ch)で指定してください。';
    }
    // 視聴回数
    if ($minutes < 1 || $minutes > 1440) {
        $validated[] = '視聴分数は1〜1440の範囲で指定してください。';
    }
    // エラーがあればエラー文を出して処理を終了する
    if (!empty($validated)) {
        foreach ($validated as $error) {
            echo $error . PHP_EOL;
        }
        exit;
    }
}

function createWatchingData($input)
{
    // スクリプト名を削除する
    array_shift($input);

    $channelData = [];

    for ($i = 0; $i < count($input); $i += 2) {
        $channel = (int)$input[$i];
        $minutes = (int)$input[$i + 1];

        validated($channel, $minutes);

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

/* あとで消す
 * docker compose exec app php watching_tv_time.php 1 30 5 25 2 30 1 15
 * docker compose exec app php watching_tv_time.php 14 30 5 25 2 30 1 15
 */
