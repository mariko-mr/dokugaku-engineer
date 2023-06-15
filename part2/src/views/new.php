<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="stylesheets/css/app.css">

    <title>読書ログの登録</title>
</head>

<body>
    <h1>読書ログの登録</h1>
    <?php if (!empty($errors)) : ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li> <?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="create.php" method="POST">
        <div>
            <label for="title">書籍名</label>
            <input type="text" id="title" name="title" value="<?php echo $book_log['title']; ?>">
        </div>
        <div>
            <label for="author">著者名</label>
            <input type="text" id="author" name="author" value="<?php echo $book_log['author']; ?>">
        </div>
        <div>
            <!-- 下記をそれぞれ修正 -->
            <label>読書状況</label>
            <div>
                <div>
                    <input type="radio" id="status_unread" name="status" value="未読" <?php echo $book_log['status'] === '未読' ?  'checked' : '' ?>>
                    <label for="status_unread">未読</label>
                </div>
                <div>
                    <input type="radio" id="status_inProgress" name="status" value="読んでいる" <?php echo $book_log['status'] === '読んでいる' ? 'checked' : '' ?>>
                    <label for="status_inProgress">読んでいる</label>
                </div>
                <div>
                    <input type="radio" id="status_completed" name="status" value="読了" <?php echo $book_log['status'] === '読了' ? 'checked' : '' ?>>
                    <label for="status_completed">読了</label>
                </div>
            </div>
        </div>
        <div>
            <label for="rating">評価(5点満点の整数)</label>
            <input type="number" id="rating" name="rating" min="1" max="5" step="1" value="<?php echo $book_log['rating'] === 0 ? '' : $book_log['rating']; ?>">
        </div>
        <div>
            <label for="review">感想</label>
            <textarea name="review" id="review"><?php echo $book_log['review']; ?></textarea>
        </div>
        <button type="submit">登録する</button>
    </form>
</body>

</html>
