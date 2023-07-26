<?php

namespace VendingMachine;

/**
 * ここを修正
 * getStock(), reduceStock()を追加
 */
abstract class Item
{
    abstract public function getPrice();
    abstract public function getCupNumber();
    abstract public function getStock();
    abstract public function reduceStock();

    public function __construct(protected string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
