<?php

class Drink
{
    const DRINK = [
        'cider' => 100,
        'coke' => 150,
    ];

    public function __construct(private string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return self::DRINK[$this->name];
    }
}
