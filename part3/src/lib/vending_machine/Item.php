<?php

namespace VendingMachine;

abstract class Item
{
    abstract public function getPrice();

    public function __construct(protected string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
