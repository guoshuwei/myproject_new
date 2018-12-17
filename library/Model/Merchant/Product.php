<?php
/**
 * @author yanzao
 * 2015-1-14
 * UTF-8
 */
class Model_Merchant_Product extends Model_BaseModel {
	/**
	 * 缓存前缀
	 * 
	 * @var unknown
	 */
	private static $tag = 'products_tag';
	private $expire_hour = 3600;
	private $table = 'products';
	function __construct(){
		// 选择连接的数据库
		parent::_init ( 'merchant' );
	}

	public function insert($data){
		$fields = $values = $insert_data = array ();
		foreach ( $data as $k => $v ) {
			$fields [] = '`' . $k . '`';
			$temp = ':' . $k;
			$insert_data[$temp] = $v;
			$values [] = $temp;
		}
		$sql = 'INSERT INTO `' . $this->table . '` (' . implode ( ',', $fields ) . ') VALUES (' . implode ( ',', $values ) . ')';
		
		$res = $this->dao->conn ( false )->noCache()->preparedSql ( $sql, $insert_data )->lastInsertId ();
		return $res;
	}

	public function selectByUid($uid){
		$sql = "SELECT * FROM {$this->table} WHERE uid={$uid}";
        $data = array();
        $res = $this->dao->conn(false)->noCache()->preparedSql($sql, $data)->fetchOne();
        return $res;
	}
	
}