<?php

require __DIR__ . '/../vendor/autoload.php';

function dbConnect()
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
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

function validate($memo)
{
    $error = '';

    if (!strlen($memo)) {
        $error = 'メモを入力して下さい';
    } elseif (strlen($memo) > 3) {
        $error = 'メモは3000字以内で入力してください';
    }

    return $error;
}

function createMemo($link)
{
    $memo = $_POST["memo"];

    $error = validate($memo);
    if (!empty($error)) {
        echo $error;
        exit;
    }

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $link = dbConnect();
    createMemo($link);
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メモ登録</title>
</head>

<body>
    <header>
        <h1>わたしのメモ帳</h1>
    </header>
    <div>
        <form action="create.php" method="post" class="">
            <div>
                <label for="memo">メモ入力欄</label>
            </div>
            <div>
                <textarea name="memo" id="memo" cols="100" rows="5"></textarea>
            </div>
            <div>
                <button type="submit">メモを登録する</button>
            </div>
        </form>
        <div>
            <a href="index.php">メモを閲覧する</a>
        </div>
    </div>
</body>

</html>
