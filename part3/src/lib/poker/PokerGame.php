<?php

namespace Poker;

require_once(__DIR__ . '/../../lib/poker/PokerCard.php');
require_once(__DIR__ . '/../../lib/poker/HandJudger.php');
require_once(__DIR__ . '/../../lib/poker/RuleTwoCard.php');
require_once(__DIR__ . '/../../lib/poker/RuleThreeCard.php');
require_once(__DIR__ . '/../../lib/poker/RuleFiveCard.php');
class PokerGame
{
    public function __construct(private array $cards1, private array $cards2)
    {
    }

    public function pokerStart(): array
    {
        $hands = [];

        foreach ([$this->cards1, $this->cards2] as $cards) {
            // [new PokerCard('CA'), new PokerCard('DA')]
            $pokerCards = array_map(fn ($card) => new PokerCard($card), $cards);
            $rule = $this->getPokerRule($cards);
            $handJudger = new HandJudger($rule);
            $hands[] = $handJudger->getHand($pokerCards);
        }
        /**
         * ここを修正
         *
         */
        $winner = $handJudger->getWinner($hands[0], $hands[1]);

        return [$hands[0]['hand_name'], $hands[1]['hand_name'], $winner];
    }

    /**
     * ここを修正
     * ルールの種類を自動的に判別する方法の追加
     */
    private function getPokerRule(array $cards): Rule
    {
        $ruleClasses = [
            2 => RuleTwoCard::class,
            3 => RuleThreeCard::class,
            5 => RuleFiveCard::class,
        ];

        $numCards = count($cards);

        if (isset($ruleClasses[$numCards])) {
            return new $ruleClasses[$numCards]();
        };

        throw new \InvalidArgumentException('Invalid number of cards: ' . $numCards);
    }
}
