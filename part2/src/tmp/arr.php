<?php

// $timed_title = '';
// $timed_author = '';
// $timed_status = '';
// $timed_rating = '';
// $timed_review = '';

// $book_log = [
//     'title' => $timed_title,
//     'author' => $timed_author,
//     'status' => $timed_status,
//     'rating' => $timed_rating,
//     'review' => $timed_review,
// ];

$book_log = [
    'title' => '',
    'author' => '',
    'status' => '',
    'rating' => '',
    'review' => '',
];

echo '書籍名：';
$book_log['title'] = mb_ereg_replace('[\s ]+', '', fgets(STDIN));
echo var_export($book_log);
