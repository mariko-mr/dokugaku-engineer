<?php

require_once ('Player.php');

class Game
{
    public function __construct(private string $name)
    {
    }

    public function start()
    {
        // プレイヤーを登録
        $player = new Player($this->name);
        // プレイヤーがカードを引く
        $cards = $player->drawCards();
        return $cards;
    }
}
