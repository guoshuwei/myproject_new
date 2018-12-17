<?php
class Module_ProductBranch_Branch {
	private static $obj = null;	
	/**
	 * 封闭构造
	 */
	private function __construct(){
		$this->branch = new Model_ProductBranch_Branch();
	}
	
	/**
	 * 单例获取
	 * 保证一条进程只产生一个Module对象
	 */
	public static function getInstance() {
		if (empty ( self::$obj )) {
			self::$obj = new Module_ProductBranch_Branch();
		}
		return self::$obj;
	}
	
	/**
	 * 插入信息
	 * @return 
	 */
	public function insert($data){
		return $this->branch->insert($data);
	}

	public function selectByUid($uid){
		if(intval($uid) < 0) return '';
		return $this->branch->selectByUid($uid);
	}
}