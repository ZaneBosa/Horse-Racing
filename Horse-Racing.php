<?php


$distance = 10;
$minSpeed = 2;
$maxSpeed = 4;
$actionSpeed = 1;

$players = explode( ' ', readline ('Enter players: '));

$track = [];

for($i = 0; $i < count($players); $i++) {
        $track[$i] = array_fill( 0, $distance, '-');
        $track[$i][0] = $players[$i];
}
$chosenPlayer = readline("Can you guess which horse will win? Your guess: ") . PHP_EOL;
$bet = (int) readline("How much would you like to put on bet? ") . PHP_EOL;
echo "Thank you! Finger crossed for $chosenPlayer - you put $bet$ on him!" . PHP_EOL;


$iteration = 0;

$winners = [];

    while(count($winners) < count($players))
    {
        system('clear');
        for($i = 0; $i <count($players); $i++) {
            $currentPosition = array_search($players[$i], $track[$i]);

            if ($currentPosition === false) continue;

            $step = rand($minSpeed, $maxSpeed);
            $nextPosition = $currentPosition + $step;

            if ($nextPosition > $distance) {
                $nextPosition = $distance;
            }

            if (! in_array($players[$i], $winners)) {
                $track[$i][$nextPosition] = $players[$i];
                $track[$i][$currentPosition] = '-';
            }

            if ($nextPosition === $distance && ! in_array($players[$i], $winners)) {
                $winners[] = $players[$i];
            }
        }
        foreach($track as $line) {
            echo implode('', $line);
            echo PHP_EOL;
        }

        $iteration++;

        sleep($actionSpeed);
    }

    foreach ($winners as $i => $player) {
        $place = $i + 1;
        echo "#{$place} - $player" . PHP_EOL;
    }

//rewards
$chosenPlayerFirst = $bet * 100;
$chosenPlayerSecond = $bet * 50;
$chosenPlayerThird = $bet * 20;
$chosenPlayerFourth = $bet * 5;

switch($chosenPlayer) {
    case $winners[0]:
        echo "Woohooo! $winners[0] just finished 1st!" . PHP_EOL;
        echo "Your prize is $chosenPlayerFirst$!!!)" . PHP_EOL;
        break;
    case $winners[1]:
        echo "Congratulations! $winners[0] just finished 2nd!" . PHP_EOL;
        echo "Your prize is $chosenPlayerSecond$!)" . PHP_EOL;
        break;
    case $winners[2]:
        echo "Not bad! $winners[0] just finished 3rd!" . PHP_EOL;
        echo "Your prize is $chosenPlayerThird$!)" . PHP_EOL;
        break;
    case $winners[3]:
        echo "No worries! $winners[0] just finished 4th!" . PHP_EOL;
        echo "Your prize is $chosenPlayerFourth$!!!)" . PHP_EOL;
        break;
    default:
        echo "Oh my, this wasn't your lucky guess... no prize for you :(";
        break;
}