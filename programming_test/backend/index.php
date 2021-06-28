<?php
// Purpose: to make DeckOfCards.php cannot access directly
define('MyDirectConst', TRUE);

require_once './DeckOfCards.php';

// Validate in server side
if (!empty($_POST['people'])) {

    // Validate in server side
    if ($_POST['people'] < 0) {
        echo 'Input value does not exist or value is invalid';
        return;
    }

    $dObjDeck = new DeckOfCards();
    ?>

    <h2>
        <?= ($dObjDeck->totalNumberOfPlayer() == 1 ? 'The' : 'Each') ?> player
        get <?= $dObjDeck->totalCardPerPlayer() ?>
        <?= ' card' . ($dObjDeck->totalCardPerPlayer() === 0 || $dObjDeck->totalCardPerPlayer() > 1 ? 's' : ''); ?>
    </h2>

    <?php
    for ($i = 1; $i <= $dObjDeck->totalNumberOfPlayer(); $i++) {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="pull-left">Card of player number <?= $i; ?></h4>
                <button class="btn btn-warning btn-show-card pull-right <?= ($i > $dObjDeck->totalOfCard()) ? 'hidden' : ''; ?> "
                        id="p<?= $i; ?>">Show the cards
                </button>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <?php
                // Check if last player number > 52
                // Show got nothing card messages
                if ($i > $dObjDeck->totalOfCard()) {
                    echo '<strong class="text-danger">Got nothing</strong>';
                    echo '</div></div>';
                    continue;
                }

                // Pick a random card with a maximum of cards per player
                $dArrRandomCard = $dObjDeck->pickupRandomCards();

                if ((is_array($dArrRandomCard))) {
                    ?>
                    <div class="row">
                        <div class="col-md-12 text-card">
                            <?php
                            $dStrCard = '';
                            foreach ($dArrRandomCard as $index) {
                                $dStrCard .= implode('-', $dObjDeck->pickupCard($index)) . ',';
                            }

                            // Output Format: e.g. S-A, H-X, .....
                            echo rtrim($dStrCard, ',');
                            ?>
                        </div>
                        <div class="col-md-12" style="display:none;" id="img-card-p<?= $i; ?>">
                            <?php
                            foreach ($dArrRandomCard as $index) {
                                echo $dObjDeck->showCard($index);
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                } else {
                    // Output Format: e.g. S-A
                    echo '<div class="col-md-12 text-card">' . implode('-', $dObjDeck->pickupCard($dArrRandomCard)) . '</div>';
                    ?>
                    <div class="col-md-12" style="display:none;" id="img-card-p<?= $i; ?>">
                        <?php echo $dObjDeck->showCard($dArrRandomCard); ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }


    if ($dObjDeck->remainingCards() > 0) {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4> Remainning cards: <?= $dObjDeck->remainingCards(); ?></h4>
            </div>
            <div class="panel-body">
                <?php

                $dStrCard = '';
                foreach ($dObjDeck->showRemainingCards() as $item) {
                    $dStrCard .= implode('-', $item) . ',';
                }

                // Output Format: e.g. S-A, H-X, .....
                echo rtrim($dStrCard, ',');
                ?>
            </div>
        </div>
        <?php
    }

    return;
}

echo 'Input value does not exist or value is invalid';
return;