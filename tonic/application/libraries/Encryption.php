<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Encryption
{
    function getEncrypt($sStr, $sKey) {
      return base64_encode(
        mcrypt_encrypt(
            MCRYPT_RIJNDAEL_128, 
            $sKey,
            $sStr,
            MCRYPT_MODE_ECB
        )
      );
    }

    function getDecrypt($sStr, $sKey) {
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

    function ucname($string) {
        $string =ucwords(strtolower($string));

        foreach (array('-', '\'') as $delimiter) {
          if (strpos($string, $delimiter)!==false) {
            $string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
          }
        }
        return $string;
    }

    function encrypt_str($stuct, $key)
    {
        $message = json_encode($stuct);
        $key = md5($key);
        $pstr = $this->pkcs5_pad($message, 16);
        $cstr = $this->getEncrypt($pstr, pack("H*", $key));
        $url = urlencode($cstr);
        return $url;
    }

    function decrypt_str($url, $key)
    {
        $key = md5($key);
        $dstr = $this->getDecrypt(urldecode($url), pack("H*", $key));
        $dstruct = json_decode($this->pkcs5_unpad($dstr, 16));
        return $dstruct;
    }
    
    function generateRandomString($length = null) 
    {
        $string = sha1(uniqid(rand(),true));
        if ($length) return substr($string,0,$length);
        return $string;
    }
}
