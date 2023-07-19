<?php

require_once(__DIR__ . '/../../lib/poker/PokerCard.php');
require_once(__DIR__ . '/../../lib/poker/HandJudger.php');
class PokerGame
{
    public function __construct(private array $cards1, private array $cards2)
    {
    }

    public function pokerStart(): array
    {
        $playerCardHands = [];

        foreach ([$this->cards1, $this->cards2] as $cards) {
            // [new PokerCard('CA'), new PokerCard('DA')]
            $pokerCards = array_map(fn ($card) => new PokerCard($card), $cards);

            /**
             * ここを追加
             * PokerPlayerクラスは不要になったので削除
             */
            $handJudger = new HandJudger($pokerCards);
            $playerCardHands[] = $handJudger->getHand();
        }

        return $playerCardHands;
    }
}
