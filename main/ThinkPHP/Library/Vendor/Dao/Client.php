<?php
class Client{
	private $dao = null;
    public function __construct(){
        //引入公共类库
        require_once THINK_PATH.'/../../library/bootstrap.php';
        // $this->dao = new Lib_Dao('main');

    }

    public function getDao($dbtag){
    	return new Lib_Dao($dbtag);
    }

    
}