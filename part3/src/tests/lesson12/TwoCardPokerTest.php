<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/lesson12/TwoCardPoker.php');

final class TwoCardPokerTest extends TestCase
{
    public function testTwoCardPokerShowDown(): void
    {
        $this->assertSame(['high card', 'pair', 2],      twoCardPokerShowDown('CK', 'DJ', 'C10', 'H10'));
        $this->assertSame(['high card', 'straight', 2],  twoCardPokerShowDown('CK', 'DJ', 'C3', 'H4'));
        $this->assertSame(['straight', 'pair', 1],       twoCardPokerShowDown('C3', 'H4', 'DK', 'SK'));
        $this->assertSame(['high card', 'high card', 1], twoCardPokerShowDown('HJ', 'SK', 'DQ', 'D10'));
        $this->assertSame(['high card', 'high card', 2], twoCardPokerShowDown('H9', 'SK', 'DK', 'D10'));
        $this->assertSame(['high card', 'high card', 0], twoCardPokerShowDown('H3', 'S5', 'D5', 'D3'));
        $this->assertSame(['pair', 'pair', 1],           twoCardPokerShowDown('CA', 'DA', 'C2', 'D2'));
        $this->assertSame(['pair', 'pair', 2],           twoCardPokerShowDown('CK', 'DK', 'CA', 'DA'));
        $this->assertSame(['pair', 'pair', 0],           twoCardPokerShowDown('C4', 'D4', 'H4', 'S4'));
        $this->assertSame(['straight', 'straight', 1],   twoCardPokerShowDown('SA', 'DK', 'C2', 'CA'));
        $this->assertSame(['straight', 'straight', 2],   twoCardPokerShowDown('C2', 'CA', 'S2', 'D3'));
        $this->assertSame(['straight', 'straight', 0],   twoCardPokerShowDown('S2', 'D3', 'C2', 'H3'));
        $this->assertSame(['pair', 'pair', 0],           twoCardPokerShowDown('SA', 'DA', 'CA', 'HA'));
        $this->assertSame(['high card', 'high card', 1], twoCardPokerShowDown('SA', 'D3', 'C2', 'H4'));
    }
}
