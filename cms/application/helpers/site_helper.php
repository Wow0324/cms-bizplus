<?php
function secure_data($str) 
{
    $output_value = htmlspecialchars($str);
    $output_value = str_replace('&amp;lt;', '&lt;', $output_value);
    $output_value = str_replace('&amp;gt;', '&gt;', $output_value);
    return $output_value;
}

function safe_data($str)
{
    $output_value = htmlspecialchars_decode($str);
    return $output_value;
}