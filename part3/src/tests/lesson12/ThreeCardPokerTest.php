<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/lesson12/ThreeCardPoker.php');

final class ThreeCardPokerTest extends TestCase
{
    public function testThreeCardPokerShowDown(): void
    {
        $this->assertSame(['high card', 'pair', 2],         threeCardPokerShowDown('CK', 'DJ', 'H9', 'C10', 'H10', 'D3'));
        $this->assertSame(['high card', 'straight', 2],     threeCardPokerShowDown('CK', 'DA', 'H2', 'C3', 'H4', 'S5'));
        $this->assertSame(['high card', 'three card', 2],   threeCardPokerShowDown('CK', 'DJ', 'H9', 'C3', 'H3', 'S3'));
        $this->assertSame(['straight', 'pair', 1],          threeCardPokerShowDown('C3', 'H4', 'S5', 'DK', 'SK', 'D10'));
        $this->assertSame(['three card', 'pair', 1],        threeCardPokerShowDown('C3', 'H3', 'S3', 'DK', 'SK', 'D10'));
        $this->assertSame(['three card', 'straight', 1],    threeCardPokerShowDown('C3', 'H3', 'S3', 'DK', 'SJ', 'DQ'));
        $this->assertSame(['high card', 'high card', 1],    threeCardPokerShowDown('HJ', 'SK', 'D9', 'DQ', 'D10', 'H8'));
        $this->assertSame(['high card', 'high card', 2],    threeCardPokerShowDown('H9', 'SK', 'H7', 'DK', 'D10', 'H5'));
        $this->assertSame(['high card', 'high card', 1],    threeCardPokerShowDown('H9', 'SK', 'H7', 'DK', 'D9', 'H5'));
        $this->assertSame(['high card', 'high card', 0],    threeCardPokerShowDown('H3', 'S5', 'C7', 'D5', 'S7', 'D3'));
        $this->assertSame(['pair', 'pair', 1],              threeCardPokerShowDown('CA', 'DA', 'DK', 'C2', 'D2', 'C3'));
        $this->assertSame(['pair', 'pair', 2],              threeCardPokerShowDown('CK', 'DK', 'SA', 'CA', 'DA', 'SK'));
        $this->assertSame(['pair', 'pair', 1],              threeCardPokerShowDown('C4', 'D4', 'S7', 'H4', 'S4', 'C6'));
        $this->assertSame(['pair', 'pair', 0],              threeCardPokerShowDown('C4', 'D4', 'S7', 'H4', 'S4', 'C7'));
        $this->assertSame(['straight', 'straight', 1],      threeCardPokerShowDown('SA', 'DK', 'DQ', 'CA', 'C2', 'D3'));
        $this->assertSame(['straight', 'straight', 1],      threeCardPokerShowDown('SA', 'DK', 'DQ', 'CK', 'CQ', 'DJ'));
        $this->assertSame(['straight', 'straight', 1],      threeCardPokerShowDown('S2', 'H3', 'D4', 'CA', 'C2', 'D3'));
        $this->assertSame(['straight', 'straight', 0],      threeCardPokerShowDown('S2', 'S3', 'S4', 'C2', 'C3', 'D4'));
        $this->assertSame(['three card', 'three card', 2],  threeCardPokerShowDown('S2', 'C2', 'D2', 'CA', 'HA', 'SA'));
        $this->assertSame(['three card', 'three card', 2],  threeCardPokerShowDown('SK', 'CK', 'DK', 'CA', 'HA', 'SA'));
        $this->assertSame(['three card', 'three card', 2],  threeCardPokerShowDown('S2', 'C2', 'D2', 'C3', 'H3', 'S3'));
    }
}
