<?php

/*******************************************
 *
 * 程序名：	加密算法
 * 作者：	    zds
 * 模块名:	encrypt.php
 * 编写日期：2016-06-07
 ********************************************
 * */
class selfencryption
{

    function keyED($string, $operation, $key = '')
    {
        $key = md5($key);
        $key_length = strlen($key);
        $string = $operation == 'DE' ? base64_decode($string) : substr(md5($string . $key), 0, 8) . $string;
        $string_length = strlen($string);
        $rndkey = $box = array();
        $result = '';
        for ($i = 0; $i <= 255; $i ++) {
            $rndkey[$i] = ord($key[$i % $key_length]);
            $box[$i] = $i;
        }
        for ($j = $i = 0; $i < 256; $i ++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $string_length; $i ++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if ($operation == 'DE') {
            if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
                return substr($result, 8);
            } else {
                return '';
            }
        } else {
            return str_replace('=', '', base64_encode($result));
        }
    }
    // 加密
    function encrypt($txt, $key)
    {
        $btxt = base64_encode($txt);
        $val = $this->keyED($btxt, "EN", $key);
        if (trim($val) == "" || trim($val) == null) {
            $val = $this->encrypt($txt, $key);
        }
        return $val;
    }
    // 解密
    function decrypt($txt, $key)
    {
        return base64_decode($this->keyED($txt, "DE", $key));
    }
}