<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once (__DIR__ . '/../lib/ReBreadShopSales.php');

final class ReBreadShopSalesTest
 extends TestCase
{
    public function test(): void
    {
        $output = <<<EOD
        2464
        1
        5 10

        EOD;

        $this->expectOutputString($output);

        $inputs = getInput(['file', '1', '10', '2', '3', '5', '1', '7', '5', '10', '1']);
        $breadSalesRecords = createBreadSalesRecords($inputs);

        $totalSales = calTotalSales($breadSalesRecords);
        $maxSalesQuantityIds = getMaxSalesQuantityIds($breadSalesRecords);
        $minSalesQuantityIds = getMinSalesQuantityIds($breadSalesRecords);

        displaySales([$totalSales], $maxSalesQuantityIds, $minSalesQuantityIds);
    }
}
