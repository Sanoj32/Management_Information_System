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

function getSemester(int $x)
{
    $semesters = array(
        1 => "First",
        2 => "Second",
        3 => "Third",
        4 => "Fourth",
        5 => "Fifth",
        6 => "Sixth",
        7 => "Seventh",
        8 => "Eighth",
    );
    return $semesters[$x];
}
