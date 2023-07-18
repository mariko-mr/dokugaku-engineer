<?php

require_once('Rule.php');

class RuleA extends Rule
{
    public function getHand(array $cards): string
    {
        return 'pair';
    }
}
