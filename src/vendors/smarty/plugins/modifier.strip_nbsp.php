<?php
function smarty_modifier_strip_nbsp($string, $replace_with_space = true){
	 if ($replace_with_space)
        return str_replace('&nbsp;','', $string);
    else
        return strip_tags($string);
}
?>