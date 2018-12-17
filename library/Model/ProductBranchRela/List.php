<?php
/**
 * @author yanzao
 * 2015-1-14
 * UTF-8
 */
class Model_ProductBranchRela_List extends Model_BaseModel {
	/**
	 * 缓存前缀
	 * 
	 * @var unknown
	 */
	private static $tag = 'product_branch_rela_tag';
	private $expire_hour = 3600;
	private $table = 't_products_branch_relation_dd';
	function __construct(){
		// 选择连接的数据库
		parent::_init ( 'main' );
	}

	public function insert($data){
		//开启事务
		$this->dao->beginTransaction();
		$fields = $values = $insert_data = array ();
		foreach ( $data as $k => $v ) {
			$fields [] = '`' . $k . '`';
			$temp = ':' . $k;
			$insert_data[$temp] = $v;
			$values [] = $temp;
		}
		$sql = 'INSERT INTO `' . $this->table . '` (' . implode ( ',', $fields ) . ') VALUES (' . implode ( ',', $values ) . ')';
		
		$res = $this->dao->conn ( false )->noCache()->preparedSql ( $sql, $insert_data )->lastInsertId ();
		if($res){
			//生成一条审批记录 ,商户id，创建者id
			$sql = "INSERT INTO `validated` ('merchantId','type','create_time') VALUES (:merchantId,:type,:create_time)";
			$v_insert_data = array(
				'merchantId' => $res,
				'type' => 1,
				'create_time' => time()
			);
			$vres = $this->dao->conn ( false )->noCache()->preparedSql ( $sql, $v_insert_data )->lastInsertId ();
			if(!$vres) $this->dao->rollback();
			$this->dao->commit();
		}
		return $vres;
	}

	public function selectAll(){
		$sql = "SELECT * FROM {$this->table}";
        $data = array();
        $res = $this->dao->conn(false)->noCache()->preparedSql($sql, $data)->fetchAll();
        return $res;
	}
	
}