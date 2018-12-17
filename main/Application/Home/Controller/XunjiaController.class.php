<?php
namespace Home\Controller;
// 本类由系统自动生成，仅供测试用途
class XunjiaController extends CommonController {
    public function __construct()
    {

        parent::__construct();
        //获取rpc配置
        $this->data_center_urls = C('API_COMPONENT.data_center');
        // print_r($this->data_center_urls);
    }
	//首页一周排行列表
	public function index()
	{
        $resultData = array();
        Vendor('Dao.DAOClient');
        $Dclient = new \DAOClient();
        $product_branch_rela_instance = $Dclient->getModule('Module_ProductBranchRela_List');
        $branch_list = $product_branch_rela_instance->selectAll();
        $selectlist = $this->seperate_PC_fun($branch_list);
        $this->assign('selectlist',$selectlist);
        // var_dump(THINK_PATH);die;
        // $dao = new Lib_Dao('main');
        // var_dump($dao);die;            
        $this->display('index');
	}

    public function seperate_PC_fun($branch_list)
    {
        $tanon = array();
        $ids_arr = array();
        foreach($branch_list as $val)
        {
            $tanon[$val['id']]['id']= $val['id'];
            $tanon[$val['id']]['name']= $val['name'];
            $tanon[$val['id']]['pid']= $val['pid'];
            array_push($ids_arr,$val['id']);
        }
        foreach($branch_list as $k => $val)
        {
            if(in_array($val['pid'],$ids_arr))//父级包含
            {
                $tanon[$val['pid']]['subname'][$val['id']] = $val['name'];
                 unset($tanon[$val['id']]);
            }
            
        }
        return $tanon;

    }
}