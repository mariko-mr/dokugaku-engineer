<?php

/* ここを修正
 * DBに接続する
 */
function connectDB()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

    if (!$link) {
        echo 'データベースに接続できませんでした。' . PHP_EOL;
        echo 'Debugging Error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    } else {
        echo 'データベースに接続できました。' . PHP_EOL;
    };

    return $link;
};

/* ここを修正
 * sqlクエリを追加
 */
function createMemo()
{
    $link = connectDB();

    echo 'メモを登録してください。' . PHP_EOL;
    $log = fgets(STDIN); // メモの入力

    $sql = <<<EOT
    INSERT INTO memo (
        memo
    ) VALUES('$log');
EOT;

    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo '登録できませんでした。';
        echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
    }else{
        echo '登録できました。';
    };

    mysqli_free_result($result);
    var_export($result);
}

function displayMemo($memos)
{
    foreach ($memos as $memo) {
        echo $memo['log'];
        echo  '-----------------------------' . PHP_EOL;
    }
};

/* ここを修正
 * createMemo()を変更
 */
createMemo();

while (true) {
    echo '1. メモを登録する' . PHP_EOL;
    echo '2. メモを閲覧する' . PHP_EOL;
    echo '9. 終了する' . PHP_EOL;
    echo 'メニュー番号を選択してください(1, 2, 9):';
    $num = intval(fgets(STDIN)); // メニュー番号の入力を整数に変換


    if ($num === 1) {
        /* ここを修正
         * createMemo()を変更
         */
        createMemo();
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
