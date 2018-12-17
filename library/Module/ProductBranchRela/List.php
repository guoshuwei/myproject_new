<?php
class Module_ProductBranchRela_List {
	private static $obj = null;	
	/**
	 * 封闭构造
	 */
	private function __construct(){
		$this->rela = new Model_ProductBranchRela_List();
	}
	
	/**
	 * 单例获取
	 * 保证一条进程只产生一个Module对象
	 */
	public static function getInstance() {
		if (empty ( self::$obj )) {
			self::$obj = new Module_ProductBranchRela_List();
		}
		return self::$obj;
	}
	
	/**
	 * 插入信息
	 * @return 
	 */
	public function insert($data){
		return $this->rela->insert($data);
	}

	public function selectAll(){
		// if(intval($uid) < 0) return '';
		return $this->rela->selectAll();
	}
}