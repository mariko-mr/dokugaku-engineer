<?php

require __DIR__ . '/../../vendor/autoload.php';

function dbConnect()
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $hostname = $_ENV['DB_HOST'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $database = $_ENV['DB_DATABASE'];

    $link = mysqli_connect($hostname, $username, $password, $database);

    if (!$link) {
        echo 'Error:データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    return $link;
}

function createMemo($link, $memo)
{


    $sql = <<< EOT
        INSERT INTO memo(memo)
        VALUES ('$memo');
EOT;

    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo 'Error:メモを登録できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        exit;
    }
}
