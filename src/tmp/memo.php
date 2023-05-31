<?php

function createMemo()
{
    echo 'メモを登録してください。' . PHP_EOL;
    $currentDay  = date('Y-m-d');
    $log = fgets(STDIN); // メモの入力
    echo '登録できました。' . PHP_EOL . PHP_EOL;

    return [
        'date' => $currentDay,
        'log' => $log,
    ];
}

function displayMemo($memos)
{
    foreach ($memos as $memo) {
        echo $memo['date'] . PHP_EOL;
        echo $memo['log'];
        echo  '-----------------------------' . PHP_EOL;
    }
};

// メモを登録する
$memos[] = createMemo();

while (true) {
    echo '1. メモを登録する' . PHP_EOL;
    echo '2. メモを閲覧する' . PHP_EOL;
    echo '9. 終了する' . PHP_EOL;
    echo 'メニュー番号を選択してください(1, 2, 9)：';
    $num = intval(fgets(STDIN)); // メニュー番号の入力を整数に変換


    if ($num === 1) {
        // メモを登録する
        $memos[] = createMemo();
    } elseif ($num === 2) {
        // メモを閲覧する
        displayMemo($memos);
    } elseif ($num === 9) {
        // 終了する
        exit;
    } else {
        echo '※【1, 2, 9】から選択してください' . PHP_EOL . PHP_EOL;
    };
}
