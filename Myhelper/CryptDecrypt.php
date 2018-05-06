<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 29/03/2018
 * Time: 15:45
 */

namespace Myhelper;


class CryptDecrypt
{
    private $key  = 'FFAADDR125ABCDEFGHIJKLMNOPQRSTUV';//32 caractaire
    private $vector= 'ACF456F810ABCDEF';//16 caractaire
    private $algo=   "rijndael-128";//MCRYPT_RIJNDAEL_128;//16 caractaire

    private   function getEnc($input)
    {
        $encrypt = new  Zend_Filter_Encrypt(array( 'algorithm'=>$this->algo, 'adapter'=>'mcrypt','key' => $this->key,'vector'=>$this->vector));
        $encrypted = $encrypt->filter($input);
        return bin2hex($encrypted);
    }

    private   function getDec($input)
    {

        $decrypt = new Zend_Filter_Decrypt(array( 'algorithm'=>$this->algo, 'adapter'=>'mcrypt','key' => $this->key,'vector'=>$this->vector));
        return   $decrypt->filter($this->hex2bin($input)) ;
    }
}