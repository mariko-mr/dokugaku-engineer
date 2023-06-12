<?php
require_once __DIR__ . '/lib/mysqli.php';

function createBookLog($book_log, $link)
{
    $createBookLogSql = <<< EOT
    INSERT INTO book_log(
        title,
        author,
        status,
        rating,
        review
    ) VALUES(
        "{$book_log['title']}",
        "{$book_log['author']}",
        "{$book_log['status']}",
        "{$book_log['rating']}",
        "{$book_log['review']}"
    );
EOT;

    $result = mysqli_query($link, $createBookLogSql);
    if (!$result) {
        echo 'Error:読書ログを追加できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
    } else {
        echo '読書ログを追加できました' . PHP_EOL;
    }
}

// var_export($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $book_log = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $_POST['status'],
        'rating' => $_POST['rating'],
        'review' => $_POST['review']
    ];

    $link = dbConnect();
    createBookLog($book_log, $link);
    mysqli_close($link);

    header("Location:index.php");
}
