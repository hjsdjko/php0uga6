<?php
session_start();
class ConfigController extends CommonController {
	public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Headers:Origin,Content-Type,Accept,token,X-Requested-With,device');
    }
    public $columData = [
        'id','name','value'
    ];
    /**
     * 分页，列表
     * get
     */
    public function page(){
        $token = $this->token();
        $tokens = json_decode(base64_decode($token),true);
        if (!isset($tokens['id']) || empty($tokens['id'])) exit(json_encode(['code'=>403,'msg'=>"你还没有登录。"]));
        $userid = $tokens['id'];
        $page = isset($_GET['page'])?$_GET['page']:"1";
        $limt = isset($_GET['limit'])?$_GET['limit']:"10";
        $sort = isset($_GET['sort'])?$_GET['sort']:"id";
        $order = isset($_GET['order'])?$_GET['order']:"asc";
        $where = "";//查询条件
        $sql = "select * from `config`".$where;
        $count = table_sql($sql);
        if ($count->num_rows < 1){
            $numberCount = 1;
        }else{
            $numberCount = $count->num_rows;
        }
        $page_count = ceil($numberCount/$limt);//页数
        $startCount = ($page-1)*10;
        $lists = "select * from `config` ".$where." order by ".$sort." ".$order." limit ".$startCount.",".$limt;
        $result = table_sql($lists);
        $arrayData = array();
        if ($result->num_rows > 0) {
            while ($datas = $result->fetch_assoc()){
                array_push($arrayData,$datas);
            }
        }
        exit(json_encode([
            'code'=>0,
            'data' => [
                "total" => $numberCount,
                "pageSize" => $limt,
                "totalPage" => $page_count,
                "currPage" => $page,
                "list" => $arrayData
            ]
        ]));
    }
    /**
     * 分页，列表list
     * get
     */
    public function lists(){
        $page = isset($_GET['page'])?$_GET['page']:"1";
        $limt = isset($_GET['limit'])?$_GET['limit']:"10";
        $sort = isset($_GET['sort'])?$_GET['sort']:"id";
        $order = isset($_GET['order'])?$_GET['order']:"asc";
        $where = " where 1 ";//查询条件
        $sql = "select * from `config`".$where;
        $count = table_sql($sql);
        if ($count->num_rows < 1){
            $numberCount = 1;
        }else{
            $numberCount = $count->num_rows;
        }
        $page_count = ceil($numberCount/$limt);//页数
        $startCount = ($page-1)*10;
        $lists = "select * from `config` ".$where." order by ".$sort." ".$order." limit ".$startCount.",".$limt;
        $result = table_sql($lists);
        $arrayData = array();
        if ($result->num_rows > 0) {
            while ($datas = $result->fetch_assoc()){
                array_push($arrayData,$datas);
            }
        }
        exit(json_encode([
            'code'=>0,
            'data' => [
                "total" => $numberCount,
                "pageSize" => $limt,
                "totalPage" => $page_count,
                "currPage" => $page,
                "list" => $arrayData
            ]
        ]));
    }
    /**
     * 新增数据接口
     * post
     */
    public function save(){
        $token = $this->token();
        $tokens = json_decode(base64_decode($token),true);
        if (!isset($tokens['id']) || empty($tokens['id'])) exit(json_encode(['code'=>403,'msg'=>"你还没有登录。"]));
        $userid = $tokens['id'];
        $keyArr = $valArr = array();
        $tmpData = strval(file_get_contents("php://input"));//Content-Type: application/json 需要用到php://input 处理输入流
        if (!empty($tmpData)&& isset($tmpData)){
            $postData = json_decode($tmpData,true);
            foreach ($postData as $key => $value){
                if (in_array($key, $this->columData)){
                    if(!empty($value) || $value === 0) {
                        array_push($keyArr,"`".$key."`");
                        array_push($valArr,"'".$value."'");
                    }
                }
            }
        }
        $k = implode(',',$keyArr);
        $v = implode(',',$valArr);
        $sql = "INSERT INTO `config` (".$k.") VALUES (".$v.")";
        $result = table_sql($sql);
        if (!$result) exit(json_encode(['code'=>500,'msg'=>"新增失败"]));
        exit(json_encode(['code'=>0]));
    }

    /**
     * 更新接口
     * post
     */
    public function update(){
        $tmpData = strval(file_get_contents("php://input"));
        $postData = json_decode($tmpData,true);
        $length = count($postData);
        $v = array();
        $i=0;
        foreach ($postData as $key => $value){
            if (in_array($key, $this->columData)){

                if ($key == "id"){
                    $id = $value;
                }
                array_push($v,$key." = '".$value."'");
            }

        }
        $value = implode(',',$v);
         $sql = "UPDATE config SET ".$value." where id = ".$id;
        $result = table_sql($sql);
        if (!$result) echo json_encode(['code'=>500,'msg'=>"修改失败"]);
        exit(json_encode(['code'=>0]));
    }
    /**
     * 查询一条数据
     * get
     */
    public function info($id=false){
        $token = $this->token();
        $tokens = json_decode(base64_decode($token),true);
        if (!isset($tokens['id']) || empty($tokens['id'])) exit(json_encode(['code'=>403,'msg'=>"你还没有登录。"]));
        $userid = $tokens['id'];
        $name = isset($_REQUEST['name'])? $_REQUEST['name']:"";
        if (!empty($id)){
            $where = "`id` = ".$id;
        }else{
            $where = "`name` = ".$name;
        }
        $sql = "select * from `config` where ".$where;
        $result = table_sql($sql);
        if (!$result) echo json_encode(['code'=>500,'msg'=>"查询数据发生错误。"]);
        if ($result->num_rows > 0) {
            // 输出数据
            while($row = $result->fetch_assoc()) {
                $lists = $row;
            }
        }
        exit(json_encode([
            'code'=>0,
            'data'=> $lists
        ]));
    }

}

