<?php

const DIGITS = 4;

/**
 * @return array<int,string>
 */
// 引き数を扱いやすく配列にする
function getArray(int $numbers): array
{
    return str_split((string)$numbers);
}

/**
 * @return array<int,int>
 */
function judge(int $correctNum, int $userAnswer): array
{
    $correct = getArray($correctNum);
    $answer = getArray($userAnswer);

    $hit = 0;
    $blow = 0;

    for ($i = 0; $i < DIGITS; $i++) {
        if (isHit($correct, $answer, $i)) {
            $hit++;
        } elseif (isBlow($correct, $answer, $i)) {
            $blow++;
        }
    }

    return [$hit, $blow];
}

/* ここを修正
 * 配列の型を宣言
 */
/**
 * @param array<int,string> $correct
 * @param array<int,string> $answer
 */
function isHit(array $correct, array $answer, int $digit): bool
{
    return $answer[$digit] === $correct[$digit];
}

/* ここを修正
 * 配列の型を宣言
 */
/**
 * @param array<int,string> $correct
 * @param array<int,string> $answer
 */
function isBlow(array $correct, array $answer, int $digit): bool
{
    return in_array($answer[$digit], $correct, true);
}

/*
◯実行例($correctNumbers, $userAnswers)
judge(5678, 5678) //=> [4, 0]
judge(5678, 7612) //=> [1, 1]
judge(5678, 8756) //=> [0, 4]
*/
