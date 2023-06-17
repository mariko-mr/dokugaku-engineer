<?php

// docker compose exec app php memos/database/init_memo_table.php

function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

    if (!$link) {
        echo 'Error:データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    echo 'データベースに接続できました' . PHP_EOL;

    return $link;
}

function dropMemoTable($link)
{
    $sql = <<< EOT
        DROP TABLE IF EXISTS memo;
EOT;

    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo 'Error:テーブルを削除できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        exit;
    }
}

function createMemoTable($link)
{
    $sql = <<< EOT
        CREATE TABLE memo(
            id INT PRIMARY KEY AUTO_INCREMENT,
            memo VARCHAR(3000) NOT NULL,
            created_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )DEFAULT CHARACTER SET utf8mb4;
EOT;

    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo 'Error:テーブルを作成できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        exit;
    }
}

$link = dbConnect();
dropMemoTable($link);
createMemoTable($link);
mysqli_close($link);
