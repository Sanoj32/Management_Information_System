<?php

function getNameOfDay(int $x)
{
    $days = array(
        '0' => 'Sunday',
        '1' => "Monday",
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thrusday',
        '5' => 'Friday',
        '6' => 'Saturday',

    );
    return $days[$x];
}
