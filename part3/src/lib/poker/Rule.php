<?php

require_once(__DIR__ . '/../../lib/poker/Rule.php');

abstract class Rule
{
    abstract public function getHand(array $pokerCards);
}
