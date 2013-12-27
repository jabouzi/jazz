<?php

function friendly_url($string, $separator = '-')
{
    setlocale(LC_CTYPE, 'en_US.UTF8');
    //$text = 'Nevalidní Český text   ééààĉçaa 5588 %&3 ';
    //$text = preg_replace('/[^\\pL0-9]+/u', '-', $text);
    $text = iconv("utf-8", "ASCII//TRANSLIT//IGNORE", $text);
    $text = preg_replace('/\\s+/', $seperator, $text);
    //$text = preg_replace('/[^-a-z0-9]+/i', '', $text);
    $text = trim($text, $seperator);
    $text = strtolower($text);

    return $text;
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
