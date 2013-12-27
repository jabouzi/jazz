<?php

function friendly_url($string, $separator = '-')
{
    setlocale(LC_CTYPE, 'en_US.UTF8');
    //$string = 'Nevalidní Český text   ééààĉçaa 5588 %&3 ';
    //$string = preg_replace('/[^\\pL0-9]+/u', '-', $string);
    $string = iconv("utf-8", "ASCII//TRANSLIT//IGNORE", $string);
    $string = preg_replace('/\\s+/', $seperator, $string);
    //$string = preg_replace('/[^-a-z0-9]+/i', '', $string);
    $string = trim($string, $seperator);
    $string = strtolower($string);

    return $string;
}

function generate_random_string($length = null) 
{
    $string = sha1(uniqid(rand(),true));
    if ($length) return substr($string,0,$length);
    return $string;
}

function ucname($string) 
{
    $string = ucwords(strtolower($string));
    foreach (array('-', '\'') as $delimiter) 
    {
        if (strpos($string, $delimiter)!==false) 
        {
            $string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
        }
    }
    return $string;
}
