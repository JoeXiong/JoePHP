<?php

/*******************************************
 * 文件名： /include/page.class.php
 * 功能：     分页类
 * 版本：      1.0
 * 日期：    2016-06-16 16:46:29
 * 作者：     JoeXiong
 * 版权：      Copyright@2016-2016 github.com/JoeXiong All Rights Reserved
 *********************************************/
class page
{

    public $page_name = "p"; // page标签，用来控制url页。比如说xxx.php?PB_page=2中的PB_page
    public $next_page = '>'; // 下一页
    public $pre_page = '<'; // 上一页
    public $first_page = 'First'; // 首页
    public $last_page = 'Last'; // 尾页
    public $pre_bar = '<<'; // 上一分页条
    public $next_bar = '>>'; // 下一分页条
    public $format_left = '';
    public $format_right = '';
    public $is_ajax = false; // 是否支持AJAX分页模式
    public $allow_key = array(); // 允许传入的URL参数
    public $uri = ''; // 传入的合法URI
    
    private $pagebarnum = 10; // 控制记录条的个数。
    private $totalpage = 0; // 总页数
    private $ajax_action_name = ''; // AJAX动作名
    private $nowindex = 1; // 当前页
    private $url = ""; // url地址头
    private $offset = 0;

    function page($array)
    {
        if (is_array($array)) {
            $total = intval($array['total']);
            $perpage = (array_key_exists('perpage', $array)) ? intval($array['perpage']) : 10;
            $nowindex = (array_key_exists('nowindex', $array)) ? intval($array['nowindex']) : '';
            $url = (array_key_exists('url', $array)) ? $array['url'] : '';
            if (array_key_exists('allow_key', $array)) {
                array_push($array['allow_key'], $this->page_name);
                $this->allow_key = is_array($array['allow_key']) ? $array['allow_key'] : array(
                    $this->page_name
                );
            }
            $this->uri = (array_key_exists('uri', $array)) ? $array['uri'] : '';
        } else {
            $total = $array;
            $perpage = 10;
            $nowindex = '';
            $url = '';
        }
        if ((! is_int($total)) || ($total < 0))
            $this->error(__FUNCTION__, $total . ' is not a positive integer!');
        if ((! is_int($perpage)) || ($perpage <= 0))
            $this->error(__FUNCTION__, $perpage . ' is not a positive integer!');
        if (! empty($array['page_name']))
            $this->set('page_name', $array['page_name']);
        $totalpage = ceil($total / $perpage);
        $this->totalpage = $totalpage < 1 ? 1 : $totalpage;
        $this->_set_nowindex($nowindex); // 设置当前页
        $this->_set_url($url); // 设置链接地址
        $this->offset = ($this->nowindex - 1) * $perpage;
        if (! empty($array['ajax']))
            $this->open_ajax($array['ajax']);
    }

    /**
     * 设定类中指定变量名的值，如果改变量不属于这个类，将throw一个exception
     * 
     * @param unknown $var            
     * @param unknown $value            
     */
    function set($var, $value)
    {
        if (in_array($var, get_object_vars($this))) {
            $this->$var = $value;
        } else {
            $this->error(__FUNCTION__, $var . " does not belong to PB_Page!");
        }
    }

    /**
     * 打开AJAX模式
     * 
     * @param unknown $action            
     */
    function open_ajax($action)
    {
        $this->is_ajax = true;
        $this->ajax_action_name = $action;
    }

    /**
     * 下一页
     */
    function next_page($style = '')
    {
        if ($this->nowindex < $this->totalpage) {
            return $this->_get_link($this->_get_url($this->nowindex + 1), $this->next_page, $style);
        }
        return '<a href="#" class="">' . $this->next_page . '</a>';
    }

    /**
     * 上一页
     *
     * @param string $style            
     * @return string
     */
    function pre_page($style = '')
    {
        if ($this->nowindex > 1) {
            return $this->_get_link($this->_get_url($this->nowindex - 1), $this->pre_page, $style);
        }
        return '<a href="#" class="">' . $this->pre_page . '</a>';
    }

    /**
     * 首页
     * 
     * @param string $style            
     * @return string
     */
    function first_page($style = '')
    {
        if ($this->nowindex == 1) {
            return '<a href="#" class="">' . $this->first_page . '</a>';
        }
        return $this->_get_link($this->_get_url(1), $this->first_page, $style);
    }

    /**
     * 尾页
     * 
     * @param string $style            
     */
    function last_page($style = '')
    {
        if ($this->nowindex == $this->totalpage) {
            return '<a href="#" class="">' . $this->first_page . '</a>';
        }
        return $this->_get_link($this->_get_url($this->totalpage), $this->last_page, $style);
    }

    function nowbar($style = '', $nowindex_style = '')
    {
        $plus = ceil($this->pagebarnum / 2);
        if (($this->pagebarnum - $plus + $this->nowindex) > $this->totalpage) {
            $plus = $this->pagebarnum - $this->totalpage + $this->nowindex;
        }
        $begin = $this->nowindex - $plus + 1;
        $begin = ($begin >= 1) ? $begin : 1;
        $return = '';
        for ($i = $begin; $i < $begin + $this->pagebarnum; $i ++) {
            if ($i <= $this->totalpage) {
                if ($i != $this->nowindex) {
                    $return .= $this->_get_text($this->_get_link($this->_get_url($i), $i, $style));
                } else {
                    $return .= $this->_get_text('<a href="#" class="cur">' . $i . '</a>');
                }
            } else {
                break;
            }
            $return .= "\n";
        }
        unset($begin);
        return $return;
    }

    /**
     * 获取显示跳转按钮
     */
    function select()
    {
        $return = '<select name="PB_Page_Select">';
        for ($i = 1; $i <= $this->totalpage; $i ++) {
            if ($i == $this->nowindex) {
                $return .= '<option value="' . $i . '" selected>' . $i . '</option>';
            } else {
                $return .= '<option value="' . $i . '">' . $i . '</option>';
            }
        }
        unset($i);
        $return .= '</select>';
        return $return;
    }
    
    /**
     * 获取mysql 语句中limit需要的值
     *
     * @return string
     */
    function offset()
    {
        return $this->offset;
    }

    /**
     * 控制分页显示风格（你可以增加相应的风格）
     *
     * @param int $mode
     * @return string
     */
    function show($mode=1)
    {
        if($this->nowindex<=0){
            $this->nowindex=1;
        }
    
        if($this->nowindex>$this->totalpage){
            $this->nowindex=$this->totalpage;
        }
        if($this->totalpage<=1){
            return;
        }
        switch ($mode)
        {
            case '1':
                $this->first_page='首页';
                $this->last_page='尾页';
                // $this->next_page="<img src='img/table/next.gif' style='border:0;height:13px'/>&nbsp;";
                // $this->pre_page="&nbsp;<img src='img/table/up.png'style='border:0;height:13px'alt='上一页'/>&nbsp;";
                $this->next_page="下一页";
                $this->pre_page="上一页";
                return $this->first_page().$this->pre_page().$this->nowbar().$this->next_page().$this->last_page();
                break;
            case '2':
                $this->next_page='下一页';
                $this->pre_page='上一页';
                $this->first_page='首页';
                $this->last_page='尾页';
                return $this->first_page().$this->pre_page().'[第'.$this->nowindex.'页]'.$this->next_page().$this->last_page().'第'.$this->select().'页';
                break;
            case '3':
                $this->next_page='下一页';
                $this->pre_page='上一页';
                $this->first_page='首页';
                $this->last_page='尾页';
                return $this->first_page().$this->pre_page().$this->next_page().$this->last_page();
                break;
            case '4':
                $this->next_page='下一页';
                $this->pre_page='上一页';
                return $this->pre_page().$this->nowbar().$this->next_page();
                break;
            case '5':
                return $this->pre_bar().$this->pre_page().$this->nowbar().$this->next_page().$this->next_bar();
                break;
        }
    }
    
    /**
     * 为url加上page
     * 
     * @param number $pageno            
     */
    function _get_url($pageno = 1)
    {
        return $this->url . $pageno;
    }

    /**
     * 获取分页显示文字
     * 
     * @param unknown $str            
     */
    function _get_text($str)
    {
        return $this->format_left . $str . $this->format_right;
    }

    /**
     * 获取链接地址
     * 
     * @param unknown $url            
     * @param unknown $text            
     * @param string $style            
     * @return string
     */
    function _get_link($url, $text, $style = '')
    {
        $style = (empty($style)) ? '' : 'class="' . $style . '"';
        if ($this->is_ajax) {
            return '<a ' . $style . ' href="javascript:' . $this->ajax_action_name . '(\'' . $url . '\')">' . $text . '</a>';
        } else {
            return '<a ' . $style . ' href="' . $url . '">' . $text . '</a>';
        }
    }

    /**
     * 设置当前页面
     * 
     * @param unknown $nowindex            
     */
    private function _set_nowindex($nowindex)
    {
        if (empty($nowindex)) {
            // 系统设置
            if (isset($_GET[$this->page_name])) {
                $nowindex = intval($_GET[$this->page_name]);
            }
        } else {
            // 手动设置
            $nowindex = intval($nowindex);
        }
        $nowindex = $nowindex < 1 ? 1 : $nowindex;
        $this->nowindex = $nowindex > $this->totalpage ? $this->totalpage : $nowindex;
    }

    /**
     * 设置url头地址
     */
    private function _set_url($url = "")
    {
        if (! empty($url)) {
            $this->url = $url . ((stristr($url, '?')) ? '&' : '?') . $this->page_name . "=";
        } else {
            $this->_deal_url();
        }
    }

    /**
     * 处理URL为合法
     */
    private function _deal_url()
    {
        if (empty($this->url)) {
            $currentUrl = $this->_get_current_url();
            $this->url = $currentUrl . (strpos($currentUrl, '?') ? '' : '?');
        }
        $urlAll = parse_url($this->url);
        if (isset($urlAll['query'])) {
            parse_str($urlAll['query'], $params);
            if (! empty($this->allow_key)) {
                foreach ($params as $key => $val) {
                    $params[$key] = htmlspecialchars(strip_tags($val));
                    if (in_array($key, $this->allow_key)) {
                        unset($params[$key]);
                    }
                }
            }
            
            if (array_key_exists($this->page_name, $params)) {
                unset($params[$this->page_name]);
            }
        }
        $this->url = (empty($this->uri) ? $urlAll['path'] : $this->uri) . '?' . (empty($params) ? '' : (http_build_query($params)));
        $last = $this->url[strlen($this->url) - 1];
        if ($last == '?' || $last == '&') {
            $this->url .= $this->page_name . '=';
        } else {
            $this->url .= '&' . $this->page_name . '=';
        }
    }

    /**
     * 获取当前页面URL
     */
    private function _get_current_url()
    {
        $pageUrl = 'http';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
            $pageUrl .= "s";
        }
        $pageUrl .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageUrl .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageUrl .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageUrl;
    }
    
    /**
     * 出错处理方式
     */
    function error($function,$errormsg)
    {
        die('Error in file <b>'.__FILE__.'</b> ,Function <b>'.$function.'()</b> :'.$errormsg);
    }
}