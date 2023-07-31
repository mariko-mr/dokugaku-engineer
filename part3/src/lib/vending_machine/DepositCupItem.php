<?php

namespace VendingMachine;

require_once(__DIR__ . '/../../lib/vending_machine/Item.php');

abstract class DepositCupItem extends Item
{
    abstract public function addCup(int $cupNumber);
    abstract public function getCupNumber();
    abstract public function reduceCup();
}
