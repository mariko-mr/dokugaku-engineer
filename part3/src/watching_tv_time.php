<?php

const MINUTES_PER_HOUR = 60;

function getInput()
{
    $inputs = $_SERVER['argv'];
    array_shift($inputs);

    return $inputs;
}

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

    return $validated;
}

function createWatchingData(array $inputs): array
{
    $channelData = [];
    $errors = [];

    for ($i = 0; $i < count($inputs); $i += 2) {
        $channel = (int)$inputs[$i];
        $minutes = (int)$inputs[$i + 1];

        $currentErrors = validated($channel, $minutes);
        // エラー文の重複を回避している
        if (!empty($currentErrors)) {
            $errors = array_replace($errors, $currentErrors);
            continue;
        }

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

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . PHP_EOL;
        }
    }

    ksort($channelData);

    return $channelData;
}

/* ここを修正
 * 視聴時間の合計方法を修正
 */
function calWatchingHour(array $channelData): void
{
    $watchingMins = array_sum(array_column($channelData,'minutes'));

    $watchingHours = round(($watchingMins / MINUTES_PER_HOUR), 1);
    echo $watchingHours . PHP_EOL;
}

function outputWatchingData(array $channelData): void
{
    foreach ($channelData as $channel => $data) {
        echo $channel . ' ' . $data['minutes'] . ' ' . $data['count'] . PHP_EOL;
    }
}

$inputs = getInput();
$channelData = createWatchingData($inputs);
calWatchingHour($channelData);
outputWatchingData($channelData);

/* あとで消す
 * docker compose exec app php watching_tv_time.php 1 30 5 25 2 30 1 15
 */
