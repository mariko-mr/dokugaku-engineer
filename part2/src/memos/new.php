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
