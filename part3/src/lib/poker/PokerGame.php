<?php

class PokerGame
{
    public function __construct(private array $cards1, private array $cards2)
    {
    }

    public function pokerStart(): array
    {
        $playerCardRanks = [];

        foreach ([$this->cards1, $this->cards2] as $cards) {
            // ['CA', 'DA']それぞれに new PokerCard インスタンスを作る
            // $pokerCards = [new PokerCard('CA'), new PokerCard('DA')]
            $pokerCards = array_map(fn ($card) => new PokerCard($card), $cards);
            $player = new PokerPlayer($pokerCards);
            $playerCardRanks[] = $player->getRanks();
        }

        return $playerCardRanks;
    }
}
