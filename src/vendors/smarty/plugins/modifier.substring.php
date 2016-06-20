<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */ 

/**
 * Smarty plugin
 *
 * Type:    modifier<br>
 * Name:    substring<br>
 * Date:    Mar 6, 2004
 * Purpose: substring
 *
 * @version 1.0
 * @author  sushener
 * @param   string
 * @param   integer
 * @param   integer
 * @return  string
 */
function smarty_modifier_substring($string, $from, $length = null)
{
    preg_match_all('/[\x80-\xff]?./', $string, $match); 

    if(is_null($length))
    {
        $result = implode('', array_slice($match[0], $from));
    }
    else
    {
        $result = implode('', array_slice($match[0], $from, $length));
    } 
    return $result;
}
?> 
