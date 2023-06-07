<?php
// $name = 'みかん';

// echo strlen($name) . PHP_EOL . PHP_EOL;

$errors = [];
// //書籍名が正しく入力されているかチェック
// if (!strlen($name)) {
//     $errors['title'] = '書籍名を入力してください';
// } elseif (strlen($name) > 2) {
//     $errors['title'] = '書籍名は255文字以内で入力してください';
// }

// echo count($errors) . PHP_EOL;
// echo $errors['title'] . PHP_EOL;

$numeric = 22;

var_dump($numeric);
var_dump((int)$numeric);

if ($numeric !== (int)$numeric) { //整数ではないなら
    $errors['rating'] = '整数を入力してください';
} elseif ($numeric < 1 || $numeric > 5) { //1以上5以下でないなら
    $errors['rating'] = '1以上5以下の整数を入力してください';
};

echo $errors['rating']. PHP_EOL;
