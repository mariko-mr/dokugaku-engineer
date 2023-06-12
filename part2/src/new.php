<?php
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>読書ログの登録</title>
</head>

<body>
    <h1>読書ログの登録</h1>
    <form action="create.php" method="POST">
        <div>
            <label for="title">書籍名</label>
            <input type="text" id="title" name="title">
        </div>
        <div>
            <label for="author">著者名</label>
            <input type="text" id="author" name="author">
        </div>
        <div>
            <label>読書状況</label>
            <div>
                <div>
                    <input type="radio" id="status_unread" name="status" value="未読" checked>
                    <label for="status_unread">未読</label>
                </div>
                <div>
                    <input type="radio" id="status_inProgress" name="status" value="読んでいる">
                    <label for="status_inProgress">読んでいる</label>
                </div>
                <div>
                    <input type="radio" id="status_completed" name="status" value="読了">
                    <label for="status_completed">読了</label>
                </div>
            </div>
        </div>
        <div>
            <label for="rating">評価(5点満点の整数)</label>
            <input type="number" id="rating" name="rating">
        </div>
        <div>
            <label for="review">感想</label>
            <textarea name="review" id="review"></textarea>
        </div>
        <button type="submit">登録する</button>
    </form>
</body>

</html>
