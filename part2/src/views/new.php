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
    <!-- header -->
    <header class="Small shadow">
        <nav class="navbar navbar-expand-lg navbar-light">
            <h1>
                <a class="text-decoration-none text-dark h2" href="index.php">読書ログ</a>
            </h1>
        </nav>
    </header>

    <div class="container">
        <!-- error -->
        <?php if (!empty($errors)) : ?>
            <ul class="text-danger mt-5">
                <?php foreach ($errors as $error) : ?>
                    <li> <?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div>
            <h2 class="h4">読書ログの登録</h2>
        </div>

        <!-- form -->
        <div class="mt-4">
            <form action="create.php" method="POST">
                <div class="form-group">
                    <label for="title">書籍名</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo $book_log['title']; ?>">
                </div>
                <div class="form-group">
                    <label for="author">著者名</label>
                    <input type="text" id="author" name="author" class="form-control" value="<?php echo $book_log['author']; ?>">
                </div>
                <div class="form-group">
                    <label>読書状況</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="status_unread" name="status" value="未読" <?php echo $book_log['status'] === '未読' ?  'checked' : 'checked' ?>>
                            <label class="form-check-label" for="status_unread">未読</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="status_inProgress" name="status" value="読んでいる" <?php echo $book_log['status'] === '読んでいる' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="status_inProgress">読んでいる</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="status_completed" name="status" value="読了" <?php echo $book_log['status'] === '読了' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="status_completed">読了</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rating">評価(5点満点の整数)</label>
                    <input type="number" id="rating" name="rating" min="1" max="5" step="1" class="form-control" value="<?php echo $book_log['rating'] === 0 ? '' : $book_log['rating']; ?>">
                </div>
                <div class="form-group">
                    <label for="review">感想</label>
                    <textarea name="review" class="form-control" id="review"><?php echo $book_log['review']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">登録する</button>
            </form>
        </div>
    </div>
</body>

</html>
