<?php
class DAOClient{
    public function __construct(){
        //引入公共类库
        require_once THINK_PATH.'/../../library/bootstrap.php';

    }

    public function getDao($dbtag){
    	return new Lib_Dao($dbtag);
    }

    public function getModule($module_tag){
    	return $module_tag::getInstance();
    }

    
}
