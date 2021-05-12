<?php

function getNameOfDay(int $x)
{
    $days = array(
        '1' => "Monday",
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thrusday',
        '5' => 'Friday',
        '6' => 'Saturday',
        '7' => 'Sunday'
    );
    return $days[$x];
}