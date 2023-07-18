<?php

require_once('Player.php');
require_once('Deck.php');
require_once('HandEvaluator.php');
require_once('RuleA.php');
require_once('RuleB.php');

class Game
{
    public function __construct(private string $name, private int $drawNum, private string $ruleType)
    {
    }

    public function start()
    {
        $deck = new Deck();
        $player = new Player($this->name);
        $cards = $player->drawCards($deck, $this->drawNum);
        $rule = $this->getRule();
        $handEvaluator = new HandEvaluator($rule);
        $hand = $handEvaluator->getHand($cards);
        return $hand;
    }

    private function getRule()
    {
        if ($this->ruleType === 'A') {
            return new RuleA;
        }

        if ($this->ruleType === 'B') {
            return new RuleB;
        }
    }
}
