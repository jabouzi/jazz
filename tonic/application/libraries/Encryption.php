<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Encryption
{
    function encrypt($input, $key)
    {
       $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
       $input = pkcs5_pad($input, $size);
       $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
       $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
       mcrypt_generic_init($td, $key, $iv);
       $data = mcrypt_generic($td, $input);
       mcrypt_generic_deinit($td);
       mcrypt_module_close($td);
       $data = base64_encode($data);
       $data = urlencode($data);
       return $data;
    }

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

    function encrypt_url($stuct, $key)
    {
        $message = json_encode($stuct);
        $key = md5($key);
        $pstr = pkcs5_pad($message, 16);
        $cstr = getEncrypt($pstr, pack("H*", $key));
        $url = urlencode($cstr);
        return $url;
    }

    function decrypt_url($url, $key)
    {
        $key = md5($key);
        $dstr = getDecrypt(urldecode($url), pack("H*", $key));
        $dstruct = json_decode(pkcs5_unpad($dstr, 16));
        return $dstruct;
    }

}
