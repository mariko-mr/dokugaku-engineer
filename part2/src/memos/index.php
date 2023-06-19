<?php

require_once __DIR__ . '/lib/mysqli.php';
require_once __DIR__ . '/lib/escape.php';

$title = 'メモ一覧';
$content = 'views/index.php';

// データベースに接続しメモを取得する
$link = dbConnect();
$memos = listMemos($link);

include 'views/layout.php';
