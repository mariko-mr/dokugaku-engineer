<?php

namespace OopPoker;

require_once ('Deck.php');
class Player
{
    public function __construct(private string $name)
    {
    }

    public function drawCards(Deck $deck, int $drawNum) // Deckクラスを受け取る
    {
        return $deck->drawCards($drawNum);
    }
}
