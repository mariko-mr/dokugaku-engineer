<?php

// データベースに接続する
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

function createMemo($link)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // バリデーション処理
        if (!strlen($_POST["memo"])) {
            echo 'メモを入力して下さい';
            exit;
        }

        $memo = $_POST["memo"];

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
}

$link = dbConnect();
createMemo($link);

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
