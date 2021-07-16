<?php

/**
 *
 * Helper Functions
 */

function test()
{
    return 'I\'m Working. I\'m composer loaded helper !!!';
}

function dateFormat($date)
{
    return \Carbon\Carbon::parse($date)->format('M d, Y \\a\\t h:i A');
}

function currentDateTime()
{
    return date('d_m_Y_h:i:s_a', time());
}
