<?php

class Player
{
    public function __construct(private string $name)
    {
    }

    public function drawCards()
    {
        $cards = $this->prepareCards();
        $cards = $this->shuffleCards($cards);
        return $this->selectCards($cards);
    }

    private function prepareCards()
    {
    }

    private function shuffleCards($cards)
    {
    }


    private function selectCards($cards)
    {
        return ['H10', 'D10'];
    }
}
