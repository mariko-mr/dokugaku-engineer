<?php

require_once __DIR__ . '/lib/mysqli.php';

function validate($memo)
{
    $error = '';

    if (!strlen($memo)) {
        $error = 'メモを入力して下さい';
    } elseif (strlen($memo) > 3000) {
        $error = 'メモは3000字以内で入力してください';
    }

    return $error;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $memo = $_POST["memo"];

    $link = dbConnect();

    $error = validate($memo);
    if (!empty($error)) {
        include 'new.php';
        exit;
    }

    createMemo($link, $memo);
    header('Location:index.php');
}
