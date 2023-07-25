<?php

namespace VendingMachine;

abstract class Item
{
    abstract public function getPrice();
    abstract public function getCupNumber();
    /**
     * ここを追加
     */
    abstract public function getDepositNumber();

    public function __construct(protected string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
