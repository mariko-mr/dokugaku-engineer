<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/PokerGame.php');

final class PokerGameTest extends TestCase
{
    public function testPokerStart(): void
    {
        // カードが2枚の場合
        $game1 = new PokerGame(['CA', 'DA'], ['C9', 'H10']);
        $this->assertSame(['pair', 'straight'], $game1->pokerStart());

        // カードが3枚の場合
        $game2 = new PokerGame(['C2', 'D2', 'S2'], ['C10', 'H9', 'DJ']);
        $this->assertSame(['three of a kind', 'straight'], $game2->pokerStart());

        // カードが5枚の場合
        $game3 = new PokerGame(['C2', 'D2', 'S2', 'H2', 'C3'], ['C10', 'H9', 'DK', 'DQ', 'SJ']);
        $this->assertSame(['four of a kind', 'straight'], $game3->pokerStart());
    }
}

/*
docker compose exec app ./vendor/bin/phpunit tests/poker/PokerGameTest.php --bootstrap vendor/autoload.php
*/
