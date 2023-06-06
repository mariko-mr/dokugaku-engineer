<?php

function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    if (!$link) {
        echo 'Error:データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    return $link;
}

function createBookLog($link)
{
    $book_log = [];

    echo '読書ログを登録して下さい' . PHP_EOL . PHP_EOL;

    echo '書籍名：';
    $book_log['title'] = trim(fgets(STDIN));

    echo '著者名：';
    $book_log['author'] = trim(fgets(STDIN));

    echo '読書状況(未読 , 読んでる, 読了):';
    $book_log['status'] = trim(fgets(STDIN));

    echo '評価：';
    $book_log['rating'] = (int)trim(fgets(STDIN));

    echo '感想：';
    $book_log['review'] = trim(fgets(STDIN));

    $validated = validate($book_log);
    if (count($validated) > 0) {
        foreach ($validated as $error) {
            echo $error . PHP_EOL;
        }
        return;
    }

    $sql = <<<EOT
    INSERT INTO book_log (
        title,
        author,
        status,
        rating,
        review
    ) VALUES (
        "{$book_log['title']}",
        "{$book_log['author']}",
        "{$book_log['status']}",
        "{$book_log['rating']}",
        "{$book_log['review']}"
    )
    EOT;

    $result = mysqli_query($link, $sql);
    if ($result) {
        echo '登録が完了しました' . PHP_EOL . PHP_EOL;
    } else {
        echo 'Error:データの追加に失敗しました' . PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
    }
};

function validate($book_log)
{
    $errors = [];

    //書籍名が正しく入力されているかチェック
    if (!strlen($book_log['title'])) {
        $errors['title'] = '書籍名を入力してください';
    } elseif (strlen($book_log['title']) > 255) {
        $errors['title'] = '書籍名は255文字以内で入力してください';
    }

    //著者名が正しく入力されているかチェック
    if (!strlen($book_log['author'])) {
        $errors['author'] = '著者名を入力してください';
    } elseif (strlen($book_log['author']) > 255) {
        $errors['author'] = '著者名は255文字以内で入力してください';
    }

    //読書状況が正しく入力されているかチェック
    $status = ['未読', '読んでる', '読了'];
    if (!strlen($book_log['status'])) {
        $errors['status'] = '読書状況を入力してください';
    } elseif (!in_array($book_log['status'], $status, TRUE)) {
        $errors['title'] = '（未読,読んでる,読了）から入力してください';
    }

    //評価(5点満点の整数)が正しく入力されているかチェック
    if ($book_log['rating'] < 1 || $book_log['rating'] > 5) { //1以上5以下でないなら
        $errors['rating'] = '1以上5以下の整数を入力してください';
    };

    //感想が正しく入力されているかチェック
    if (!strlen($book_log['review'])) {
        $errors['review'] = '感想を入力してください';
    } elseif (strlen($book_log['review']) > 1000) {
        $errors['review'] = '感想は1000文字以内で入力してください';
    }

    return $errors;
};

function displayBookLog($link)
{
    /*
     * displayBookLog関数を修正
     */

    $sql = <<< EOT
    SELECT title, author, status, rating, review
    FROM book_log
    EOT;

    $results = mysqli_query($link, $sql);

    while ($book_log = mysqli_fetch_assoc($results)) {
        echo '書籍名：' . $book_log['title'] . PHP_EOL;
        echo '著者名：' . $book_log['author'] . PHP_EOL;
        echo '読書状況：' . $book_log['status'] . PHP_EOL;
        echo '評価：' . $book_log['rating'] . PHP_EOL;
        echo '感想：' . $book_log['review'] . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }

    mysqli_free_result($results);
};

$link = dbConnect();

while (true) {
    echo '1. 読書ログを登録' . PHP_EOL;
    echo '2. 読書ログを表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL . PHP_EOL;
    echo '番号を選択してください(1,2,9):';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        createBookLog($link);
    } elseif ($num === '2') {
    /*
     * displayBookLog関数の引数を修正
     */
        displayBookLog($link);
    } elseif ($num === '9') {
        mysqli_close($link);
        break;
    }
};
