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

function createBookLog($link)
{
    $book_logs = [];

    echo '読書ログを登録して下さい' . PHP_EOL . PHP_EOL;

    echo '書籍名：';
    $book_logs['title'] = trim(fgets(STDIN));

    echo '著者名：';
    $book_logs['author'] = trim(fgets(STDIN));

    echo '読書状況(未読 , 読んでる, 読了):';
    $book_logs['status'] = trim(fgets(STDIN));

    echo '評価：';
    $book_logs['rating'] = (int)trim(fgets(STDIN));

    echo '感想：';
    $book_logs['review'] = trim(fgets(STDIN));

    $validated = validate($book_logs);
    if (count($validated) > 0) {
        foreach ($validated as $error); {
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
        "{$book_logs['title']}",
        "{$book_logs['author']}",
        "{$book_logs['status']}",
        "{$book_logs['rating']}",
        "{$book_logs['review']}"
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

function validate($book_logs)
{
    $errors = [];
    //書籍名が正しく入力されているかチェック
    if (!strlen($book_logs['title'])) {
        $errors['title'] = '書籍名を入力してください';
    } elseif (strlen($book_logs['title']) > 255) {
        $errors['title'] = '書籍名は255文字以内で入力してください';
    }

    //評価(5点満点の整数)が正しく入力されているかチェック
    if ($book_logs['rating'] !== (int)$book_logs['rating']) { //整数ではないなら
        $errors['rating'] = '整数を入力してください';
    } elseif ($book_logs['rating'] < 1 || $book_logs['rating'] > 5) { //1以上5以下でないなら
        $errors['rating'] = '1以上5以下の整数を入力してください';
    };

    return $errors;
};

// function displayBookLog($bookLogs)
// {
//     foreach ($bookLogs as $bookLog) {
//         echo '書籍名：' . $bookLog['title'] . PHP_EOL;
//         echo '著者名：' . $bookLog['author'] . PHP_EOL;
//         echo '読書状況：' . $bookLog['status'] . PHP_EOL;
//         echo '評価：' . $bookLog['rating'] . PHP_EOL;
//         echo '感想：' . $bookLog['review'] . PHP_EOL;
//         echo '-------------' . PHP_EOL;
//     }
// };

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
        // displayBookLog($bookLogs);
    } elseif ($num === '9') {
        mysqli_close($link);
        echo 'データーベースとの接続を切断しました' . PHP_EOL;
        break;
    }
};
