<?php

require_once __DIR__ . '/lib/mysqli.php';
require_once __DIR__ . '/lib/escape.php';

function listBookLog($link)
{
    $sql = <<< EOT
 SELECT title, author , status , rating , review
 FROM book_log;
EOT;

    // SQL文を実行して結果を取得
    $results = mysqli_query($link, $sql);

    $book_logs = [];
    // 結果をそれぞれ$book_logsにいれる
    while ($book_log = mysqli_fetch_assoc($results)) {
        $book_logs[] = $book_log;
    };

    mysqli_free_result($results);

    return $book_logs;
}

$link = dbConnect();
$book_logs = listBookLog($link);

$title = '読書ログの一覧';
$content = __DIR__ . '/views/index.php';

include __DIR__ . '/views/layout.php';
