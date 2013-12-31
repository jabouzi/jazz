<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configs
{
	function __construct()
	{
		$this->load->helper('directory');
		$this->load->helper('file');
	}
	
	function get_modules_list()
	{
		
	}

	function decrypt_str($sStr, $sKey) {
		return mcrypt_decrypt(
			MCRYPT_RIJNDAEL_128, 
			$sKey,
			base64_decode($sStr), 
			MCRYPT_MODE_ECB
		);
	}

	function pkcs5_pad ($text, $blocksize) { 
	  $pad = $blocksize - (strlen($text) % $blocksize); 
	  return $text . str_repeat(chr($pad), $pad); 
	}

	function pkcs5_unpad($text, $blocksize)
	{
	   $pad = ord($text{strlen($text)-1});
	   if ($pad > strlen($text)) return false;
	   return substr($text, 0, -1 * $pad);
	}

	function encrypt_url($stuct, $key)
	{
		$message = json_encode($stuct);
		$key = md5($key);
		$pstr = $this->pkcs5_pad($message, 16);
		$cstr = $this->encrypt_str($pstr, pack("H*", $key));
		$url = urlencode($cstr);
		return $url;
	}

	function decrypt_url($url, $key)
	{
		$key = md5($key);
		$dstr = $this->decrypt_str(urldecode($url), pack("H*", $key));
		$dstruct = json_decode($this->pkcs5_unpad($dstr, 16));
		return $dstruct;
	}
}
