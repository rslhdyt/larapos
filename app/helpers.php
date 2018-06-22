<?php

// currency helper
function currency($amount, $currency = 'Rp.')
{
    return $currency . number_format($amount, 2, '.', ',');
}
