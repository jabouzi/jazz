<?php

function friendly_url($string, $separator = '-')
{
    setlocale(LC_ALL, 'en_US.UTF8');
    $url = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
    $url = preg_replace('/[^a-zA-Z0-9 -]/', '', $url);
    $url = trim(strtolower($url));
    $url = preg_replace('/[s' . $separator . ']+/', $separator, $url);
    $url = trim(strtolower($url),'-');
    return $url;
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
