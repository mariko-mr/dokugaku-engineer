<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/lesson11/ReSuperMarket.php');

final class ReSuperMarketTest extends TestCase
{
    public function testReCalc(): void
    {
        $this->assertSame(1298, reCalc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]));
    }
}
