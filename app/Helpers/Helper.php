<?php

function getYears($startYear = null, $range = 100): array
{
    $currentYear = $startYear ?: date('Y');
    $endYear = $currentYear - $range;
    $years = range($currentYear, $endYear);
    return $years;
}

