<?php
class Module_Merchant_Product {
	private static $obj = null;	
	/**
	 * 封闭构造
	 */
	private function __construct(){
		$this->product = new Model_Merchant_Product();
	}
	
	/**
	 * 单例获取
	 * 保证一条进程只产生一个Module对象
	 */
	public static function getInstance() {
		if (empty ( self::$obj )) {
			self::$obj = new Module_Merchant_Product();
		}
		return self::$obj;
	}
	
	/**
	 * 插入信息
	 * @return 
	 */
	public function insert($data){
		return $this->product->insert($data);
	}

	public function selectByUid($uid){
		if(intval($uid) < 0) return '';
		return $this->product->selectByUid($uid);
	}
}