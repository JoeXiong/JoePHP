<?php

/*******************************************
 *
 * 程序名：	常用公共方法
 * 模块名:	public.func.php
 * 编写日期：2016-06-06 
 ********************************************
 * */
class funcPunlic
{

    /**
     * 获得提交者的IP地址
     */
    public static function getIp()
    {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["REMOTE_ADDR"])) {
            $ip = $_SERVER["REMOTE_ADDR"];
        } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } elseif (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } elseif (getenv("REMOTE_ADDR")) {
            $ip = getenv("REMOTE_ADDR");
        } else {
            $ip = "Unknown";
        }
        return $ip;
    }

    /**
     * 解析上一个页面专递过来的加密参数的地址
     *
     * @return string
     */
    public static function analyticUrl()
    {
        if (isset($_POST["hd_backurl"])) {
            return base64_decode(urldecode($_POST["hd_backurl"]));
        }
        
        if (isset($_GET["iu"])) {
            return base64_decode(urldecode($_GET["iu"]));
        }
        
        return "";
    }

    /**
     * 加密上一个页面传递过来的加密地址参数
     *
     * @param unknown $url            
     * @return string
     */
    public static function encryptionUrl($url)
    {
        return urlencode(base64_encode($url));
    }

    /**
     * 计算字符串的长度（汉字按照一个字符计算）
     *
     * @param unknown $str            
     * @return number
     */
    public static function myStrLen($str)
    {
        $length = strlen(preg_replace('/[\x00-\x7F]/', '', $str));
        
        if ($length) {
            return strlen($str) - $length + intval($length / 3) * 1;
        } else {
            return strlen($str);
        }
    }

    /**
     * 判断是否是中文
     *
     * @param unknown $str            
     * @return boolean
     */
    public static function isChinese($str)
    {
        if (preg_match("/^[\x7f-\xff]+$/", $str)) { // 兼容gb2312,utf-8
            return true;
        } else {
            return false;
        }
    }

    /**
     * 将一个字串中含有半角字符转换为全角字符
     *
     * @param $str 待转换字串            
     * @return $str 处理后字串
     */
    public static function makeSemiangle($str)
    {
        $arr = array(
            '0' => '０',
            '1' => '１',
            '2' => '２',
            '3' => '３',
            '4' => '４',
            '5' => '５',
            '6' => '６',
            '7' => '７',
            '8' => '８',
            '9' => '９',
            'A' => 'Ａ',
            'B' => 'Ｂ',
            'C' => 'Ｃ',
            'D' => 'Ｄ',
            'E' => 'Ｅ',
            'F' => 'Ｆ',
            'G' => 'Ｇ',
            'H' => 'Ｈ',
            'I' => 'Ｉ',
            'J' => 'Ｊ',
            'K' => 'Ｋ',
            'L' => 'Ｌ',
            'M' => 'Ｍ',
            'N' => 'Ｎ',
            'O' => 'Ｏ',
            'P' => 'Ｐ',
            'Q' => 'Ｑ',
            'R' => 'Ｒ',
            'S' => 'Ｓ',
            'T' => 'Ｔ',
            'U' => 'Ｕ',
            'V' => 'Ｖ',
            'W' => 'Ｗ',
            'X' => 'Ｘ',
            'Y' => 'Ｙ',
            'Z' => 'Ｚ',
            'a' => 'ａ',
            'b' => 'ｂ',
            'c' => 'ｃ',
            'd' => 'ｄ',
            'e' => 'ｅ',
            'f' => 'ｆ',
            'g' => 'ｇ',
            'h' => 'ｈ',
            'i' => 'ｉ',
            'j' => 'ｊ',
            'k' => 'ｋ',
            'l' => 'ｌ',
            'm' => 'ｍ',
            'n' => 'ｎ',
            'o' => 'ｏ',
            'p' => 'ｐ',
            'q' => 'ｑ',
            'r' => 'ｒ',
            's' => 'ｓ',
            't' => 'ｔ',
            'u' => 'ｕ',
            'v' => 'ｖ',
            'w' => 'ｗ',
            'x' => 'ｘ',
            'y' => 'ｙ',
            'z' => 'ｚ',
            '(' => '（',
            ')' => '）',
            '[' => '【',
            ']' => '】',
            '{' => '｛',
            '}' => '｝',
            '<' => '《',
            '>' => '》',
            '%' => '％',
            '+' => '＋',
            '-' => '——',
            '～' => '-',
            ':' => '：',
            '。' => '.',
            '、' => ',',
            '、' => '.',
            ';' => '；',
            '?' => '？',
            '!' => '！',
            '…' => '-',
            '‖' => '|',
            '"' => '”',
            '`' => '’',
            '`' => '‘',
            '|' => '｜',
            '"' => '〃'
        );
        
        return strtr($str, $arr);
    }

    /**
     * 转换特殊字符
     *
     * @param unknown $string            
     * @return mixed
     */
    public static function safeReplace($string)
    {
        $string = str_replace('%20', '', $string);
        $string = str_replace('%27', '', $string);
        $string = str_replace('*', '', $string);
        $string = str_replace('"', '&quot;', $string);
        $string = str_replace("'", '', $string);
        $string = str_replace("\"", '', $string);
        $string = str_replace('//', '', $string);
        $string = str_replace(';', '', $string);
        $string = str_replace('<', '&lt;', $string);
        $string = str_replace('>', '&gt;', $string);
        $string = str_replace('(', '', $string);
        $string = str_replace(')', '', $string);
        $string = str_replace("{", '', $string);
        $string = str_replace('}', '', $string);
        return $string;
    }

    /**
     * UTF-8转GBK
     *
     * @param unknown $name            
     * @return string
     */
    public static function getGbkString($name)
    {
        $tostr = "";
        for ($i = 0; $i < strlen($name); $i ++) {
            $curbin = ord(substr($name, $i, 1));
            if ($curbin < 0x80) {
                $tostr .= substr($name, $i, 1);
            } elseif ($curbin < bindec("11000000")) {
                $str = substr($name, $i, 1);
                $tostr .= "&#" . ord($str) . ";";
            } elseif ($curbin < bindec("11100000")) {
                $str = substr($name, $i, 2);
                $tostr .= "&#" . self::getUnicodeChar($str) . ";";
                $i += 1;
            } elseif ($curbin < bindec("11110000")) {
                $str = substr($name, $i, 3);
                $gstr = iconv("UTF-8", "gbk", $str);
                if (! $gstr) {
                    $tostr .= "&#" . self::getUnicodeChar($str) . ";";
                } else {
                    $tostr .= $gstr;
                }
                $i += 2;
            } elseif ($curbin < bindec("11111000")) {
                $str = substr($name, $i, 4);
                $tostr .= "&#" . self::getUnicodeChar($str) . ";";
                $i += 3;
            } elseif ($curbin < bindec("11111100")) {
                $str = substr($name, $i, 5);
                $tostr .= "&#" . self::getUnicodeChar($str) . ";";
                $i += 4;
            } else {
                $str = substr($name, $i, 6);
                $tostr .= "&#" . self::getUnicodeChar($str) . ";";
                $i += 5;
            }
        }
        return $tostr;
    }

    /**
     * 获得字符串Unicode值
     *
     * @param unknown $str            
     * @return number
     */
    public static function getUnicodeChar($str)
    {
        $temp = "";
        for ($i = 0; $i < strlen($str); $i ++) {
            $x = decbin(ord(substr($str, $i, 1)));
            if ($i == 0) {
                $s = strlen($str) + 1;
                $temp .= substr($x, $s, 8 - $s);
            } else {
                $temp .= substr($x, 2, 6);
            }
        }
        return bindec($temp);
    }

    /**
     * 处理Get/POST提交过来的值--数组处理
     *
     * @param unknown $getParameters            
     * @return unknown
     */
    public static function filterGetParameters($getParameters)
    {
        foreach ($getParameters as $get_key => $get_var) {
            if (is_numeric($get_var)) {
                $getParameters[strtolower($get_key)] = self::getInt($get_var);
            } else {
                $getParameters[strtolower($get_key)] = self::getStr($get_var);
            }
        }
        return $getParameters;
    }

    /**
     * 处理Get/POST提交过来的值--单个处理
     *
     * @param unknown $getParameters            
     * @return unknown
     */
    public static function filterParameter($getParameter)
    {
        if (is_numeric($getParameter)) {
            $getParameter = self::getInt($getParameter);
        } else {
            $getParameter = self::getStr($getParameter);
        }
        return $getParameter;
    }

    /**
     * 整型过滤函数
     *
     * @param unknown $number            
     */
    public static function getInt($number)
    {
        return intval($number);
    }

    /**
     * 字符串型过滤函数
     *
     * @param unknown $string            
     */
    public static function getStr($string)
    {
        $value = $string;
        if (! get_magic_quotes_gpc()) {
            $value = addslashes($string);
        }
        $value = str_replace("_", "\\_", $value); // 把 '_'过滤掉
        $value = str_replace("%", "\\%", $value); // 把' % '过滤掉
        $value = nl2br($value); // 回车转换;
        $value = htmlspecialchars($value); // html标记转换
        $value = self::safeSqlReplace($value);
        return $value;
    }

    /**
     * 转换特殊字符,防止SQL注入
     *
     * @access public
     * @param $string 字符串            
     * @return string
     *
     */
    public static function safeSqlReplace($string)
    {
        $string = str_replace('%20', '', $string);
        $string = str_replace('%27', '', $string);
        $string = str_replace('*', '', $string);
        $string = str_replace('"', '&quot;', $string);
        $string = str_replace("'", '', $string);
        $string = str_replace("%", '', $string);
        $string = str_replace("\"", '', $string);
        $string = str_replace('//', '', $string);
        $string = str_replace(';', '', $string);
        $string = str_replace('-', '', $string);
        $string = str_replace('and', '[and]', $string);
        $string = str_replace('or', '[or]', $string);
        $string = str_replace('select', '[select]', $string);
        $string = str_replace('update', '[update]', $string);
        $string = str_replace('from', '[from]', $string);
        $string = str_replace('where', '[where]', $string);
        $string = str_replace('order', '[order]', $string);
        $string = str_replace('by', '[by]', $string);
        $string = str_replace('delete', '[delete]', $string);
        $string = str_replace('insert', '[insert]', $string);
        $string = str_replace('into', '[into]', $string);
        $string = str_replace('values', '[values]', $string);
        $string = str_replace('create', '[create]', $string);
        $string = str_replace('table', '[table]', $string);
        $string = str_replace('database', '[database]', $string);
        $string = str_replace('load_file', '[load_file]', $string);
        $string = str_replace('outfile', '[outfile]', $string);
        $string = str_replace('union', '[union]', $string);
        return $string;
    }

    /**
     * 截取字符串，中文
     *
     * @param unknown $str            
     * @param unknown $from            
     * @param unknown $len            
     * @return string|Ambigous
     */
    public static function kcSubstr($str, $from, $len)
    {
        preg_match_all('#(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+)#s', $str, $array, PREG_PATTERN_ORDER);
        $from1 = 0;
        $len1 = 0;
        $s = '';
        foreach ($array[0] as $key => $val) {
            $n = ord($val) >= 128 ? 2 : 1;
            $from1 += $n;
            if ($from1 > $from) {
                $len1 += $n;
                if ($len1 <= $len) {
                    $s .= $val;
                } else {
                    return $s . '';
                }
            }
        }
        return $s;
    }

    /**
     * Curl请求
     *
     * @param string $requesturl
     *            //请求URL
     * @param string $reuqestmothed
     *            //请求方法 默认false（为GET） true（为POST）
     * @param int $httpcode
     *            http状态码 以引用的形式传递
     * @param int $postdata
     *            post的数据
     * @return string or false
     */
    public static function curlRequest($requesturl, $reuqestmethod = false, & $httpcode = 0, $postdata = NULL)
    {
        try {
            $options = array(
                CURLOPT_URL => $requesturl,
                CURLOPT_RETURNTRANSFER => true, // 启用回去返回数据
                CURLOPT_FOLLOWLOCATION => true, // follow redirects
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_POST => $reuqestmethod
            );
            if (true === $reuqestmethod) {
                $options[CURLOPT_POSTFIELDS] = $postdata;
            }
            $ch = curl_init(); // 初始化
            curl_setopt_array($ch, $options); // 参数设置
            $rs = curl_exec($ch); // 执行s
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // http状态码
            curl_close($ch);
            unset($ch);
            return $rs;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 调试输出函数
     * @param unknown $msg
     */
    public static function show_bug($msg)
    {
        echo "<pre>";
        var_dump($msg);
        echo "</pre>";
    }
}
