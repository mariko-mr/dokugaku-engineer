<?php


function connectDb()
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


function createMemo($link)
{
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
    } else {
        echo '登録できました。' . PHP_EOL . PHP_EOL;
    };
}

/* ここを修正
 * displayMemo()を変更
 */
function displayMemo($link)
{
    $sql = <<< EOT
    SELECT memo, created_time FROM memo
EOT;

    $results = mysqli_query($link, $sql);

    while ($memo = mysqli_fetch_array($results)) {
        echo $memo['memo'] . PHP_EOL . PHP_EOL;
        echo $memo['created_time'] . PHP_EOL;
        echo '-------------------------' . PHP_EOL . PHP_EOL;
    };

    mysqli_free_result($results);
};

$link = connectDb();
createMemo($link);

while (true) {
    echo '1. メモを登録する' . PHP_EOL;
    echo '2. メモを閲覧する' . PHP_EOL;
    echo '9. 終了する' . PHP_EOL;
    echo 'メニュー番号を選択してください(1, 2, 9):';
    $num = intval(fgets(STDIN)); // メニュー番号の入力を整数に変換


    if ($num === 1) {
        createMemo($link);
    } elseif ($num === 2) {
        /* ここを修正
         * displayMemo()引数を修正
         */
        displayMemo($link);
    } elseif ($num === 9) {
        /* ここを修正
         * mysqli_close()を修正
         */
        mysqli_close($link);
        exit;
    } else {
        echo '※【1, 2, 9】から選択してください' . PHP_EOL . PHP_EOL;
    };
}
