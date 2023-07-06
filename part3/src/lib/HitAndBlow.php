<?php

/* ここを修正
 * 桁数を定数とする
 */
const DIGITS = 4;

/**
 * @return array<int,string>
 */
// 引き数を扱いやすく配列にする
function getArray(int $numbers): array
{
    return str_split((string)$numbers);
}

/* ここを修正
 * ループ条件の数値をを定数へ変更
 */
/**
 * @return array<int,int>
 */
function judge(int $correctNumbers, int $userAnswers): array
{
    $correctNumbers = getArray($correctNumbers);
    $userAnswers = getArray($userAnswers);

    $hit = 0;
    $blow = 0;

    for ($i = 0; $i < DIGITS; $i++) {
        if ($userAnswers[$i] === $correctNumbers[$i]) {
            // $userAnswersのi番目が$correctNumbersのi番目と同じなら$hit
            $hit++;
        } elseif (in_array($userAnswers[$i], $correctNumbers, true)) {
            // $userAnswersのi番目が$correctNumbersに含まれるなら$blow
            $blow++;
        }
    }

    return [$hit, $blow];
}

/*
◯実行例($correctNumbers, $userAnswers)
judge(5678, 5678) //=> [4, 0]
judge(5678, 7612) //=> [1, 1]
judge(5678, 8756) //=> [0, 4]
*/
