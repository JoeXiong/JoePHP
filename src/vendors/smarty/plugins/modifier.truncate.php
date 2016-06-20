<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/*
*
 * Smarty truncate modifier plugin
 *
 * Type:     modifier<br>
 * Name:     truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *           optionally splitting in the middle of a word, and
 *           appending the $etc string or inserting $etc into the middle.
 * @link http://smarty.php.net/manual/en/language.modifier.truncate.php
 *          truncate (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param integer
 * @param string
 * @param boolean
 * @param boolean
 * @return string
 */
/*
function smarty_modifier_truncate($string, $length = 80, $etc = '...',
                                  $break_words = false, $middle = false)
{
    if ($length == 0)
        return '';

    if (strlen($string) > $length) {
        $length -= min($length, strlen($etc));
        if (!$break_words && !$middle) {
            $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
        }
        if(!$middle) {
            return substr($string, 0, $length) . $etc;
        } else {
            return substr($string, 0, $length/2) . $etc . substr($string, -$length/2);
        }
    } else {
        return $string;
    }
}
*/
/* vim: set expandtab: */


/*function smarty_modifier_truncate($string, $sublen = 80, $etc = '...', $break_words = false, $middle = false)
{
$start=0;
$code="UTF-8";
       if($code == 'UTF-8') 
   { 
       $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/"; 
       preg_match_all($pa, $string, $t_string);
       if(count($t_string[0]) - $start > $sublen) 
       	return join('', array_slice($t_string[0], $start, $sublen))."$etc"; 
       return join('', array_slice($t_string[0], $start, $sublen)); 
   } 
   else 
   { 
       $start = $start*2; 
       $sublen = $sublen*2; 
       $strlen = strlen($string); 
       $tmpstr = '';

       for($i=0; $i<$strlen; $i++) 
       { 
           if($i>=$start && $i<($start+$sublen)) 
           { 
               if(ord(substr($string, $i, 1))>129) 
               { 
                   $tmpstr.= substr($string, $i, 2); 
               } 
               else 
               { 
                   $tmpstr.= substr($string, $i, 1); 
               } 
           } 
           if(ord(substr($string, $i, 1))>129) $i++; 
       } 
       if(strlen($tmpstr)<$strlen ) $tmpstr.= "$etc"; 
       return $tmpstr; 
   }
}*/
function smarty_modifier_truncate($string, $sublen = 80, $etc = '',$break_words = false, $middle = false) {
	if(empty($string)) {
		return;
	}
	$etclength = strlen($etc);
	$isUtf8 = strlen('拼音') > 4 ? TRUE : FALSE;
	if($isUtf8) {
		$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
		$t_string = array();
		preg_match_all($pa, $string, $t_string);
		$strlength = count($t_string[0]);
		$tmp = 0;
		for($i = 0; $i < $strlength; $i++) {
			$single_tmp = strlen($t_string[0][$i]) > 2 ? 2 : 1;
			if($single_tmp + $tmp > $sublen) {
				break;
			}
			$tmp += $single_tmp;
		}
		$newstring = implode('', array_slice($t_string[0], 0, $i));
	}
	else {
		$strlength = strlen($string);
		$long = 0;
		for($i = 0; $i < $strlength; $i++) {
			$isdouble = (ord($string[$i]) > 129) ? TRUE : FALSE;
			$add = $isdouble ? 2 : 1;
			if($long + $add > $sublen) {
				break;
			}
			$long += $add;
		}
		$newstring = substr($string, 0, $long);
	}
	return  $newstring == $string ? $newstring : $newstring . $etc;
}
?>
