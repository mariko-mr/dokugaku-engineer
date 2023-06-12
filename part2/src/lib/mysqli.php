<?php //library

require __DIR__ . '/../vendor/autoload.php'; //現在のディレクトリ(__DIR__)のその下(/../..)にあるvendor/autoload/phpを読み込む

function dbConnect()
{

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/..');
    $dotenv->load();

    $dbHost = $_ENV['DB_HOST'];
    $dbUserName = $_ENV['DB_USERNAME'];
    $dbPassword = $_ENV['DB_PASSWORD'];
    $dbDatabase = $_ENV['DB_DATABASE'];

    $link = mysqli_connect($dbHost,  $dbUserName, $dbPassword, $dbDatabase);
    if (!$link) {
        echo 'Error:データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    return $link;
}
