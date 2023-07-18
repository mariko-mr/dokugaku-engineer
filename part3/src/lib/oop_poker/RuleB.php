<?php

require_once('Rule.php');

class RuleB extends Rule
{
    public function getHand(array $cards): string
    {
        return 'high card';
    }
}
