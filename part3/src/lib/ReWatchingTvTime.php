<?php

const SPLIT_BY_TWO = 2;
const MINUTES_PER_HOUR = 60;

function getInput(array $argv)
{
    $inputs = array_slice($argv, 1);

    // データを扱いやすい配列に直す[[1, 30],[5, 25],...]
    return array_chunk($inputs, SPLIT_BY_TWO);
}

function createViewingRecords(array $inputs): array
{
    $viewingRecords = [];  // [$channel => $togetherMinutes]

    foreach ($inputs as $input) {
        $channel = $input[0]; // チャンネル番号
        $minutes = $input[1]; // 視聴分数
        $togetherMinutes = [$minutes];  // 視聴分数を格納する配列

        if (array_key_exists($channel, $viewingRecords)) {
            $togetherMinutes = [...$viewingRecords[$channel], ...$togetherMinutes];
        }

        // 視聴分数を更新
        $viewingRecords[$channel] = $togetherMinutes;
    }

    ksort($viewingRecords);
    return $viewingRecords;
}


function calTotalViewingHours(array $viewingRecords): float
{
    $totalViewingTimes = array_sum(array_merge(...$viewingRecords));
    return round(($totalViewingTimes / MINUTES_PER_HOUR), 1);
}

function display(array $viewingRecords): void
{
    $totalViewingHours = calTotalViewingHours($viewingRecords);
    echo $totalViewingHours . PHP_EOL; // 1.7

    foreach ($viewingRecords as $channel => $togetherMinutes) { // $togetherMinutesは配列
        echo $channel . ' ' . array_sum($togetherMinutes) . ' ' . count($togetherMinutes) . PHP_EOL;  // 1 45 2
    }
}


$inputs = getInput($_SERVER['argv']);
$viewingRecords = createViewingRecords($inputs);
display($viewingRecords);
