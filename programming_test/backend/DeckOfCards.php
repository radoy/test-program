<?php
if (!defined('MyDirectConst')) die('Direct access not permitted');

class DeckOfCards
{
    private $dObjDeckOfCards;
    private $dIntNumberOfPlayer;
    private $dIntCardPerPlayer;

    // Define Max. number of cards
    const NCARDS = 52;

    public function __construct()
    {
        $this->dObjDeckOfCards = $this->deck();

        $this->dIntNumberOfPlayer = floor($_POST['people']);
        $this->dIntCardPerPlayer = floor(self::NCARDS / $this->dIntNumberOfPlayer);

        // Check if $dIntNumberOfPlayer more than NCARDS
        if ($this->dIntNumberOfPlayer > self::NCARDS && $this->dIntCardPerPlayer == 0) {
            $this->dIntCardPerPlayer = 1;
        }
    }

    private function deck()
    {
        //Set up the deck
        $dArrRank = ['A', '2', '3', '4', '5', '6', '7', '8', '9', 'X', 'J', 'Q', 'K'];
        $dArrSuit = ['C', 'D', 'H', 'S'];

        //Generate card
        foreach ($dArrSuit as $dItemSuit) {
            foreach ($dArrRank as $dItemRank) {
                $dArrCard[] = [$dItemSuit, $dItemRank];
            }
        }

        shuffle($dArrCard);

        return $dArrCard;
    }

    public function totalOfCard(): int
    {
        return self::NCARDS;
    }

    public function totalNumberOfPlayer(): int
    {
        return $this->dIntNumberOfPlayer;
    }

    public function totalCardPerPlayer(): int
    {
        return $this->dIntCardPerPlayer;
    }

    public function pickupRandomCards()
    {
        return array_rand($this->dObjDeckOfCards, $this->dIntCardPerPlayer);
    }

    public function pickupCard($pIntIndex)
    {
        return $this->dObjDeckOfCards[$pIntIndex];
    }

    public function remainingCards()
    {
        return count($this->dObjDeckOfCards);
    }

    public function showRemainingCards()
    {
        return $this->dObjDeckOfCards;
    }

    public function showCard($pIntIndex)
    {
        $dTemp = $this->dObjDeckOfCards[$pIntIndex];

        // Don't include again after the card is shown
        // Remove from array deck
        unset($this->dObjDeckOfCards[$pIntIndex]);

        $pArrItem = str_replace('X', '10', $dTemp);
        return '<img class=" m-l-15 card" src="./../assets/cards/' . implode('', array_reverse($pArrItem)) . '.svg" />';
    }
}