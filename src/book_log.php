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
     * INSERT 文を実行し、テーブルにデータを登録するようにする
     * VALUES で $rating 以外を "" で囲っているのは文字列を VALUES に指定する必要があるため
     * $rating は整数なので文字列にする必要がない
     *
     * なお、$rating には現在文字列が入っているので、型を意識して
     * $rating = (int) trim(fgets(STDIN));
     * として、文字列を整数に変換した
     */
function createBookLog()
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

    echo '登録が完了しました' . PHP_EOL . PHP_EOL;

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

    return $sql;
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
        * MySQLにデータを保存
        */
        $sql = createBookLog();
        $result = mysqli_query($link, $sql);
        if ($result) {
            echo 'データを追加しました' . PHP_EOL;
        } else {
            echo 'Error:データの追加に失敗しました'. PHP_EOL;
            echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        }

    } elseif ($num === '2') {
        displayBookLog($bookLogs);
    } elseif ($num === '9') {
        //アプリケーションを終了
        mysqli_close($link);
        echo 'データーベースとの接続を切断しました' . PHP_EOL;
        break;
    }
};
