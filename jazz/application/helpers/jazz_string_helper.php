<?php

function friendly_url($string, $separator = '-')
{
	setlocale(LC_CTYPE, 'en_US.UTF8');
	$string = iconv("utf-8", "ASCII//TRANSLIT//IGNORE", $string);
	$string = preg_replace('/\\s+/', $separator, $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); 
        $string = preg_replace('/-+/', '-', $string);
	$string = trim($string, $separator);
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

function to_boolean($str)
{
	if (strtolower($str) == 'false') return false;
	return true;
}
