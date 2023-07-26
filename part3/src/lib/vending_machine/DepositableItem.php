<?php

namespace VendingMachine;

require_once(__DIR__ . '/../../lib/vending_machine/Item.php');

abstract class DepositItem extends Item
{
    abstract public function getMaxDeposit();
}
