<?php
/*************************************************
 * 文件名：homecategory.dm.class.php
 * 功能：    模型层-表：wpw_homecategory 描述：首页栏目
 * 版本：    1.0
 * 日期：    2016/4/19 11:00:13
 * 作者：    JoeXiong
 * 版权：   Copyright@2016-2016 github.com/JoeXiong Inc All Rights Reserved
 */

class homecategoryDmodel{
	private $_id;	//int(11)
	private $_name;	//栏目名称varchar(100)
	private $_type;	//0文字，1图片，3推荐商品，4推荐店铺int(11) unsigned
	private $_linkurl;	//链接地址varchar(500)
	private $_linkpicpath;	//链接图片varchar(255)
	private $_imagetime;	//图片上传时间int(10)
	private $_domainkey;	//图片访问地址二级域名varchar(10)
	private $_linkpoint;	//描述varchar(100)
	private $_parentid;	//上级Idint(11) unsigned
	private $_depth;	//深度级别int(11) unsigned
	private $_ordernum;	//排序int(11) unsigned
	private $_categorytype;	//栏目类型int(11)
	private $_addtime;	//添加时间int(11) unsigned

	/**
	 *@param int $_id
	 */
	public function setId($_id){
		$this->_id=$_id;
	}
	/**
	 *@return int
	 */
	public function getId(){
		return $this->_id;
	}

	/**
	 *@param string $_name
	 */
	public function setName($_name){
		$this->_name=$_name;
	}
	/**
	 *@return string
	 */
	public function getName(){
		return $this->_name;
	}

	/**
	 *@param int $_type
	 */
	public function setType($_type){
		$this->_type=$_type;
	}
	/**
	 *@return int
	 */
	public function getType(){
		return $this->_type;
	}

	/**
	 *@param string $_linkurl
	 */
	public function setLinkUrl($_linkurl){
		$this->_linkurl=$_linkurl;
	}
	/**
	 *@return string
	 */
	public function getLinkUrl(){
		return $this->_linkurl;
	}

	/**
	 *@param string $_linkpicpath
	 */
	public function setLinkpicPath($_linkpicpath){
		$this->_linkpicpath=$_linkpicpath;
	}
	/**
	 *@return string
	 */
	public function getLinkpicPath(){
		return $this->_linkpicpath;
	}

	/**
	 *@param int $_imagetime
	 */
	public function setImageTime($_imagetime){
		$this->_imagetime=$_imagetime;
	}
	/**
	 *@return int
	 */
	public function getImageTime(){
		return $this->_imagetime;
	}

	/**
	 *@param string $_domainkey
	 */
	public function setDomainKey($_domainkey){
		$this->_domainkey=$_domainkey;
	}
	/**
	 *@return string
	 */
	public function getDomainKey(){
		return $this->_domainkey;
	}

	/**
	 *@param string $_linkpoint
	 */
	public function setLinkPoint($_linkpoint){
		$this->_linkpoint=$_linkpoint;
	}
	/**
	 *@return string
	 */
	public function getLinkPoint(){
		return $this->_linkpoint;
	}

	/**
	 *@param int $_parentid
	 */
	public function setParentId($_parentid){
		$this->_parentid=$_parentid;
	}
	/**
	 *@return int
	 */
	public function getParentId(){
		return $this->_parentid;
	}

	/**
	 *@param int $_depth
	 */
	public function setDepth($_depth){
		$this->_depth=$_depth;
	}
	/**
	 *@return int
	 */
	public function getDepth(){
		return $this->_depth;
	}

	/**
	 *@param int $_ordernum
	 */
	public function setOrderNum($_ordernum){
		$this->_ordernum=$_ordernum;
	}
	/**
	 *@return int
	 */
	public function getOrderNum(){
		return $this->_ordernum;
	}

	/**
	 *@param int $_categorytype
	 */
	public function setCategoryType($_categorytype){
		$this->_categorytype=$_categorytype;
	}
	/**
	 *@return int
	 */
	public function getCategoryType(){
		return $this->_categorytype;
	}

	/**
	 *@param int $_addtime
	 */
	public function setAddTime($_addtime){
		$this->_addtime=$_addtime;
	}
	/**
	 *@return int
	 */
	public function getAddTime(){
		return $this->_addtime;
	}
}
?>
