<?php

namespace VendingMachine;

require_once(__DIR__ . '/../../lib/vending_machine/Item.php');

/**
 * ここを修正
 * getStockNumber(),reduceStock()を追加
 */
abstract class DepositItem extends Item
{
    abstract public function depositItem(int $stockNumber);
    abstract public function getStockNumber();
    abstract public function reduceStock();
}
