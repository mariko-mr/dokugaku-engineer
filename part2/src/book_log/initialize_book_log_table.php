<?php

function connectDb()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    if (!$link) {
        echo 'Error:データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    return $link;
}

function dropTable($link)
{
    $dropTableSql = 'DROP TABLE IF EXISTS book_log;';
    $result = mysqli_query($link, $dropTableSql);
    if(!$result){
        echo 'Error:テーブルを削除できませんでした'.PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
    }else{
        echo 'Error:テーブルを削除できました'.PHP_EOL;
    }
}

function createTable($link)
{
    $createTableSql = <<<EOT
    CREATE TABLE book_log(
        id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255),
        author VARCHAR(255),
        status VARCHAR(255),
        rating INTEGER,
        review VARCHAR(1000),
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) DEFAULT CHARACTER SET = utf8mb4;
EOT;

    $result = mysqli_query($link, $createTableSql);
    if(!$result){
        echo 'Error:テーブルを作成できませんでした'.PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
    }else{
        echo 'Error:テーブルを作成できました'.PHP_EOL;
    }
}


$link = connectDb();
dropTable($link);
createTable($link);
mysqli_close($link);
