<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once (__DIR__ . '/../lib/ReWatchingTvTime.php');

final class ReWatchingTvTimeTest extends TestCase
{
    public function test(): void
    {
        $output = <<<EOD
        1.7
        1 45 2
        2 30 1
        5 25 1

        EOD;
        $this->expectOutputString($output);

        $inputs = getInput(['file', '1', '30', '5', '25', '2', '30', '1', '15']);
        $viewingRecords = createViewingRecords($inputs);
        display($viewingRecords);
    }
}
