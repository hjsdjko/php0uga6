<?php
session_start();
class UsersController extends CommonController {
	public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Headers:Origin,Content-Type,Accept,token,X-Requested-With,device');
    }
    public $columData = [
        'id','addtime','username','password','role'
    ];
    /**
     * 登录接口
     * POST
     * */
    public function login(){
        $username = isset($_REQUEST['username'])?$_REQUEST['username']:"";
        $password = isset($_REQUEST['password'])?$_REQUEST['password']:"";
        $sql = "select * from `users` where username = '".$username."' and password = '".$password."'";
        $result = table_sql($sql);
        if ($result->num_rows > 0) {
            // 输出数据
            while($row = $result->fetch_assoc()) {
                $token_array = [
                    "iat" => time(), //签发时间
                    "exp" => time()+7200, //token 过期时间
                    'tablename'=> 'users',//表名
					'isAdmin' => 1,
                    'id' => $row["id"],
                    "success" => $row,//记录的uid的信息，如果有其它信息，可以再添加数组的键值对
                ];
                $tokens = base64_encode(json_encode($token_array));
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
     * 获取session
     */
    public function session(){
        $token = $this->token();
        $data = json_decode(base64_decode($token),true);
        $arrayData = $data['success'];
        exit(json_encode(['code'=>0,'data'=>$arrayData]));
    }
    /**
     * 找回密码 重置为123456
     **/
    public function resetPass(){
        $username = input('post.username');
        $counts = "select * from `users` where username = '".$username."'";
        $cotte = table_sql($counts);
        if($cotte->num_rows<1){
            exit(json_encode(['code'=>500,'msg'=>"用户名错误。"]));
        }
        $sql = "update users set password = '123456' where username = '".$username."'";
        $result = table_sql($sql);
        if($result) exit(json_encode(['code'=>500,'msg'=>"重置密码错误。"]));
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
        $page = isset($_REQUEST['page'])?$_REQUEST['page']:"1";
        $limt = isset($_REQUEST['limit'])?$_REQUEST['limit']:"10";
        $sort = isset($_REQUEST['sort'])?$_REQUEST['sort']:"id";
        $order = isset($_REQUEST['order'])?$_REQUEST['order']:"asc";
        $where = "";//查询条件
        $sql = "select * from `users`".$where;
        $count = table_sql($sql);
        if ($count->num_rows < 1){
            $numberCount = 1;
        }else{
            $numberCount = $count->num_rows;
        }
        $page_count = ceil($numberCount/$limt);//页数
        $startCount = ($page-1)*10;
        $lists = "select * from `users` ".$where." order by ".$sort." ".$order." limit ".$startCount.",".$limt;
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
                "total" => $count,
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
                    array_push($keyArr,"`".$key."`");
                    array_push($valArr,"'".$value."'");
                }
            }
        }
        $k = implode(',',$keyArr);
        $v = implode(',',$valArr);
        $sql = "INSERT INTO `users` (".$k.") VALUES (".$v.")";
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
        $v = array();
        foreach ($postData as $key => $value){
            if (in_array($key, $this->columData)){
                array_push($v,$key." = '".$value."'");
            }
        }
        $value = implode(',',$v);
         $sql = "UPDATE users SET ".$value;
        $result = table_sql($sql);
        if (!$result) exit(json_encode(['code'=>500,'msg'=>"修改失败"]));
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
        $sql = "delete from users WHERE id in({$str})";
        $result = table_sql($sql);
        if (!$result) exit(json_encode(['code'=>500,'msg'=>"删除失败。"]));
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
        $sql = "select * from `users` where ".$where;
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
}

