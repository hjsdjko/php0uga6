<?php
session_start();
class YonghuController extends CommonController {

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Headers:Origin,Content-Type,Accept,token,X-Requested-With,device');
    }
    public $columData = [
		'id','addtime'
                ,'zhanghao'
                ,'xingming'
                ,'mima'
                ,'xingbie'
                ,'lianxidianhua'
                ,'touxiang'
            ];
        /**
     * 登录接口
     * POST
     * */
    public function login(){
        $username = isset($_REQUEST['username'])?$_REQUEST['username']:"";
        $password = isset($_REQUEST['password'])?$_REQUEST['password']:"";
                        $sql = "select * from `yonghu` where `zhanghao` = '".$username."' and `mima` = '".$password."'";
                                                                                                                        $result = table_sql($sql);
        if ($result->num_rows > 0) {
            // 输出数据
            while($row = $result->fetch_assoc()) {
                                $token_array = [
                    "iat" => time(), //签发时间
                    "exp" => time()+7200, //token 过期时间
                    'tablename'=> 'yonghu',//表名
                    'columData' => $this->columData,
                    'id' => $row['id'],
                                        'isAdmin' => 0,
                                        "success" => $row,//记录的uid的信息，如果有其它信息，可以再添加数组的键值对
                    'username' => $row['zhanghao'],
                ];
                $tokens = base64_encode(json_encode($token_array));
                $_SESSION[$tokens] = $row["id"];
                                                $colum = "zhanghao";
                $md5 = md5($row["id"]."+10086");
                $_SESSION[$md5] = $row[$colum];
                                                                                                                                                                                                				
                $data = ['code' => 0, 'token' => $tokens];
                exit(json_encode($data));
            }
        } else {
            exit(json_encode(['code'=>500,'msg'=>"账号或密码错误"]));
        }
    }
    /**
     * 退出
     * post
     */
    public function logout(){
        $token = $this->token();
        unset($token);
        exit(json_encode(['code'=>0,'msg'=>'退出成功']));
    }
    /**
     * 注册
     * post
     */
    public function register(){
        $tmpData = strval(file_get_contents("php://input"));
        $postData = json_decode($tmpData,true);
                        $colum = "zhanghao";
        $trues = "select * from `yonghu` where `zhanghao` = '".$postData[$colum]."'";
                                                                                                		        $result = table_sql($trues);
        if($result->num_rows<1){
			$keyArr = $valArr = array();
			foreach ($postData as $key => $value){
                if (in_array($key, $this->columData)){
                    array_push($keyArr,"`".$key."`");
                    array_push($valArr,"'".$value."'");
                }
            }
			$key = implode(',',$keyArr);
			$v = implode(',',$valArr);
                        $sql = "INSERT INTO `yonghu` (`id`,".$key.") VALUES (".time().",".$v.")";
                        $result = table_sql($sql);
            if (!$result) exit(json_encode(['code'=>500,'msg'=>'注册失败。']));
            exit(json_encode(['code'=>0]));
        }
        exit(json_encode(['code'=>500,'msg'=>"用户名已存在。"]));
    }
    /**
     * 获取session
     */
    public function session(){
        $token = $this->token();
        $data = json_decode(base64_decode($token),true);
        $dbname = $data['tablename'];
		$uid = $data['id'];
		$sql = "select * from ".$dbname." where id=".$uid;
		$result = table_sql($sql);
        if ($result->num_rows > 0) {
            // 输出数据
            while($row = $result->fetch_assoc()) {
				$arrayData = $row;
			}
		}
        exit(json_encode(['code'=>0,'data'=>$arrayData]));
    }
    /**
     * 找回密码 重置为123456
     **/
    public function resetPass(){
        $username = $_REQUEST['username'];
                        $counts = "select * from `yonghu` where zhanghao = '".$username."'";
        $cotte = table_sql($counts);
        if($cotte->num_rows<1){
            exit(json_encode(['code'=>500,'msg'=>"用户名错误。"]));
        }
        $sql = "update yonghu set mima = '123456' where zhanghao = '".$username."'";
                                                                                                        		        $result = table_sql($sql);
        exit(json_encode(['code'=>0,'msg'=>"密码已重置为：123456"]));
    }
        /**
     * 分页，列表
     * get
     */
    public function page(){
        $token = $this->token();
        $tokens = json_decode(base64_decode($token),true);
        if (!isset($tokens['id']) || empty($tokens['id'])) exit(json_encode(['code'=>403,'msg'=>"你还没有登录。"]));
        $userid = $tokens['id'];
		$where = " where 1 ";//查询条件
                                                                                                                				
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:"1";
        $limt = isset($_REQUEST['limit'])?$_REQUEST['limit']:"10";
        $sort = isset($_REQUEST['sort'])?$_REQUEST['sort']:"id";
        $order = isset($_REQUEST['order'])?$_REQUEST['order']:"asc";
        foreach ($_REQUEST as $k => $val){
			if(in_array($k, $this->columData)){
                if ($val != ''){
                    $where.= " and ".$k." like '".$val."'";
                }
			}
        }
                                        $base = json_decode(base64_decode($token),true);
        if ($base['isAdmin']!=1){
            $md5 = md5($userid."+10086");
            $colum = "zhanghao";
            $columData = $base['columData'];
            if (isset($_SESSION[$md5]) && in_array($colum, $columData)){
                if($base['tablename'] == '${column.authTable}'){
                    $where .= " and `zhanghao` = '".$_SESSION[$md5]."'";
                }
            }
        }
                                                                                                        		        
                                        $sql = "select * from `yonghu` ".$where;
        $count = table_sql($sql);
        if ($count->num_rows < 1){
            $numberCount = 0;
        }else{
            $numberCount = $count->num_rows;
        }
        $page_count = ceil($numberCount/$limt);//页数
        $startCount = ($page-1)*$limt;
                    $lists = "select * from `yonghu` ".$where." order by ".$sort." ".$order." limit ".$startCount.",".$limt;
                
        
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
                $page = isset($_REQUEST['page'])?$_REQUEST['page']:"1";
        $limt = isset($_REQUEST['limit'])?$_REQUEST['limit']:"10";
        $sort = isset($_REQUEST['sort'])?$_REQUEST['sort']:"id";
        $order = isset($_REQUEST['order'])?$_REQUEST['order']:"asc";
        $refid = isset($_REQUEST['refid']) ? $_REQUEST['refid'] : "0";
		$where = " where 1 ";//查询条件
                                                                                                                				foreach ($_REQUEST as $k => $val){
			if(in_array($k, $this->columData)){
				$where.= " and ".$k." like '".$val."'";
			}
        }
		                
                		                                $sql = "select * from `yonghu`".$where;
        $count = table_sql($sql);
        if ($count->num_rows < 1){
            $numberCount = 0;
        }else{
            $numberCount = $count->num_rows;
        }
        $page_count = ceil($numberCount/$limt);//页数
        $startCount = ($page-1)*$limt;
        $lists = "select * from `yonghu` ".$where." order by ".$sort." ".$order." limit ".$startCount.",".$limt;
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
        $uid = $tokens['id'];
                $keyArr = $valArr = array();
        $tmpData = strval(file_get_contents("php://input"));//Content-Type: application/json 需要用到php://input 处理输入流
        
        if (!empty($tmpData)&& isset($tmpData)){
            $postData = json_decode($tmpData,true);
			            foreach ($postData as $key => $value){
                if (in_array($key, $this->columData)){
                    if(!empty($value) || $value == 0) {
                        if ($key == 'id') {
                            continue;
                        }
                        array_push($keyArr,"`".$key."`");
                        if($key == 'clicktime') {
                            array_push($valArr,"'".date('Y-m-d h:i:s', time())."'");
                        } else {
                            array_push($valArr,"'".$value."'");
                        }
                    }
                }
            }
        }
                $k = implode(',',$keyArr);
        $v = implode(',',$valArr);
                        $sql = "INSERT INTO `yonghu` (`id`,".$k.") VALUES (".time().",".$v.")";
                $result = table_sql($sql);
		        exit(json_encode(['code'=>0]));
    }
    /**
     * 新增数据接口 add
     * post
     */
    public function add(){
        $keyArr = $valArr = array();
		                        $tmpData = strval(file_get_contents("php://input"));
        if (!empty($tmpData)&& isset($tmpData)){
            $postData = json_decode($tmpData,true);
			            foreach ($postData as $key => $value){
                if (in_array($key, $this->columData)){
                    if(!empty($value) || $value == 0) {
                        if ($key == 'id') {
                            continue;
                        }
                        array_push($keyArr,"`".$key."`");
                        if($key == 'clicktime') {
                            array_push($valArr,"'".date('Y-m-d h:i:s', time())."'");
                        } else {
                            array_push($valArr,"'".$value."'");
                        }
                    }
                }
            }
        }
        $k = implode(',',$keyArr);
        $v = implode(',',$valArr);
                $sql = "INSERT INTO `yonghu` (".$k.") VALUES (".$v.")";
        $result = table_sql($sql);
		        exit(json_encode(['code'=>0]));
    }
    /**
     * 更新接口
     * post
     */
    public function update(){
        $tmpData = strval(file_get_contents("php://input"));
        $postData = json_decode($tmpData,true);
        $v = array();
        foreach ($postData as $key => $value){
            if (in_array($key, $this->columData)){
                if ($key == "id"){
                    $id = $value;
                }
                if(!empty($value) || $value === 0) {
                    array_push($v,$key." = '".$value."'");
                }
            }
        }
        $value = implode(',',$v);
         $sql = "UPDATE yonghu SET ".$value." where id = ".$id;
        $result = table_sql($sql);
        exit(json_encode(['code'=>0]));
    }
    /**
     * 删除
     * post
     */
    public function delete(){
        $ids = strval(file_get_contents("php://input"));//发现接收的是字符串
        preg_match_all('/\d+/',$ids,$arr);
        $str = implode(',',$arr[0]);//拼接字符，
        $sql = "delete from yonghu WHERE id in({$str})";
        $result = table_sql($sql);
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
                        $sql = "select * from `yonghu` where ".$where;
        $result = table_sql($sql);
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
    /**
     * 查询一条数据
     * get
     */
    public function detail($id=false){
                $name = isset($_REQUEST['name'])? $_REQUEST['name']:"";
        if ($id){
            $where = "`id` = ".$id;
        }else{
            $where = "`name` = ".$name;
        }
                        $sql = "select * from `yonghu` where ".$where;
        $result = table_sql($sql);
        if (!$result) exit(json_encode(['code'=>500,'msg'=>"查询数据发生错误。"]));
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
            
    
    /**
     * 获取需要提醒的记录数接口
     * get
     */
    public function remind($columnName,$type){
        $remindStart = isset($_GET['remindstart'])?$_GET['remindstart']:"";
        $remindEnd = isset($_GET['remindend'])?$_GET['remindend']:"";
        $where = '';
                if ($type == 1){//数字
            if ($remindStart && $remindEnd){
                $where .= " and ".$columnName."<='".$remindEnd."' and ".$columnName.">='".$remindStart."'";
            }elseif($remindStart){
                $where .= " and ".$columnName.">='".$remindStart."'";
            }elseif($remindEnd){
                $where .= " and ".$columnName."<='".$remindEnd."'";
            }
        }else{
            if ($remindStart && $remindEnd){
                $where .= " and ".$columnName."<='".date("Y-m-d",strtotime("+".$remindEnd." day"))."' and ".$columnName.">='".date("Y-m-d",strtotime("+".$remindStart." day"))."'";
            }elseif($remindStart){
                $where .= " and ".$columnName.">='".date("Y-m-d",strtotime("+".$remindStart." day"))."'";
            }elseif($remindEnd){
                $where .= " and ".$columnName."<='".date("Y-m-d",strtotime("+".$remindEnd." day"))."'";
            }
            
        }
        $sql = "select * from `yonghu` where 1 ".$where;
        $result = table_sql($sql);
        exit(json_encode(['code'=> 0 ,'count' => $result->num_rows]));
    }

    }

