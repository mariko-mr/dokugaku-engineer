<?php
require_once __DIR__ . '/lib/mysqli.php';

function createBookLog($book_log, $link)
{
    $createBookLogSql = <<< EOT
    INSERT INTO book_log(
        title,
        author,
        status,
        rating,
        review
    ) VALUES(
        "{$book_log['title']}",
        "{$book_log['author']}",
        "{$book_log['status']}",
        "{$book_log['rating']}",
        "{$book_log['review']}"
    );
EOT;

    $result = mysqli_query($link, $createBookLogSql);
    if (!$result) {
        echo 'Error:読書ログを追加できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
    } else {
        echo '読書ログを追加できました' . PHP_EOL;
    }
}

function validate($book_log)
{

    $errors = [];

    // title
    if (!strlen($book_log['title'])) {
        $errors['title'] =  '書籍名を入力してください';
    } elseif (strlen($book_log['title']) > 255) {
        $errors['title'] =  '書籍名は255文字以内で入力してください';
    }

    // author
    if (!strlen($book_log['author'])) {
        $errors['author'] =  '著者名を入力してください';
    } elseif (strlen($book_log['author']) > 255) {
        $errors['author'] =  '著者名は255文字以内で入力してください';
    }

    // status
    $status = ['未読', '読んでいる', '読了'];
    if (!strlen($book_log['status'])) {
        $errors['status'] =  '読書状況を入力してください';
    } elseif (!in_array($book_log['status'], $status, true)) {
        $errors['status'] =  '未読、読んでいる、読了から選択してください';
    }

    // rating
    if (!is_int($book_log['rating'])) {
        $errors['rating'] = '整数を入力してください';
    } elseif ($book_log['rating'] < 1 || $book_log['rating'] > 5) {
        $errors['rating'] = '評価は1~5の整数を入力してください';
    }

    // review
    if (!strlen($book_log['review'])) {
        $errors['review'] =  '感想を入力してください';
    } elseif (strlen($book_log['review']) > 1000) {
        $errors['review'] =  '感想は1,000文字以内で入力してください';
    }

    return $errors;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $book_log = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $_POST['status'],
        'rating' => (int)$_POST['rating'],
        'review' => $_POST['review']
    ];

    $errors = validate($book_log);

    if (empty($errors)) {
        $link = dbConnect();
        createBookLog($book_log, $link);
        mysqli_close($link);

        header("Location:index.php");
    }
}
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
            <input type="number" id="rating" name="rating" min="1" max="5" step="1">
        </div>
        <div>
            <label for="review">感想</label>
            <textarea name="review" id="review"></textarea>
        </div>
        <button type="submit">登録する</button>
    </form>
</body>

</html>
