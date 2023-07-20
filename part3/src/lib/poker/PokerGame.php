<?php

require_once(__DIR__ . '/../../lib/poker/PokerCard.php');
require_once(__DIR__ . '/../../lib/poker/HandJudger.php');
require_once(__DIR__ . '/../../lib/poker/RuleTwoCard.php');
require_once(__DIR__ . '/../../lib/poker/RuleThreeCard.php');
class PokerGame
{
    public function __construct(private array $cards1, private array $cards2)
    {
    }

    public function pokerStart(): array
    {
        $playerCardHands = [];

        foreach ([$this->cards1, $this->cards2] as $cards) {
            // [new PokerCard('CA'), new PokerCard('DA')]
            $pokerCards = array_map(fn ($card) => new PokerCard($card), $cards);
            $rule = $this->getPokerRule();
            $handJudger = new HandJudger($rule);
            $playerCardHands[] = $handJudger->getHand($pokerCards);
        }

        return $playerCardHands;
    }

    private function getPokerRule()
    {
        if (count($this->cards1) === count($this->cards2) === 2) {
            return new RuleTwoCard();
        }

        if (count($this->cards1) === count($this->cards2) === 3) {
            return new RuleThreeCard();
        }
    }
}
