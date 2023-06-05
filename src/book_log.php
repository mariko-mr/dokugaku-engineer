<?php

function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    if (!$link) {
        echo 'Error:データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    echo 'データーベースに接続できました' . PHP_EOL . PHP_EOL;

    return $link;
}

    /*
     * ここ以下を修正
     *
     * エラー処理も関数に追加
     * 引数で$linkを受け取る
     */
function createBookLog($link)
{
    // 読書ログを登録
    echo '読書ログを登録して下さい' . PHP_EOL . PHP_EOL;

    echo '書籍名：';
    $title = trim(fgets(STDIN));

    echo '著者名：';
    $author = trim(fgets(STDIN));

    echo '読書状況(未読 , 読んでる, 読了)：';
    $status = trim(fgets(STDIN));

    echo '評価：';
    $rating = (int)trim(fgets(STDIN));

    echo '感想：';
    $review = trim(fgets(STDIN));

    $sql = <<<EOT
    INSERT INTO book_log (
        title,
        author,
        status,
        rating,
        review
    ) VALUES (
        '$title',
        '$author',
        '$status',
        $rating,
        '$review'
    )
    EOT;

    $result = mysqli_query($link, $sql);
    if ($result) {
        echo '登録が完了しました' . PHP_EOL. PHP_EOL;
    } else {
        echo 'Error:データの追加に失敗しました'. PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
    }
};

function displayBookLog($bookLogs)
{
    //読書ログを表示
    foreach ($bookLogs as $bookLog) {
        echo '書籍名：' . $bookLog['title'] . PHP_EOL;
        echo '著者名：' . $bookLog['author'] . PHP_EOL;
        echo '読書状況：' . $bookLog['status'] . PHP_EOL;
        echo '評価：' . $bookLog['rating'] . PHP_EOL;
        echo '感想：' . $bookLog['review'] . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }
};


$link = dbConnect();

while (true) {
    echo '1. 読書ログを登録' . PHP_EOL;
    echo '2. 読書ログを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL . PHP_EOL;
    echo '番号を選択してください(1,2,9)：';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        /*
        * ここを修正
        * 引数に$linkを追加
        */
        $sql = createBookLog($link);

    } elseif ($num === '2') {
        displayBookLog($bookLogs);
    } elseif ($num === '9') {
        //アプリケーションを終了
        mysqli_close($link);
        echo 'データーベースとの接続を切断しました' . PHP_EOL;
        break;
    }
};
