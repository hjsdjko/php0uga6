<?php
require_once("./config.php");
class CommonController{
	public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Headers:Origin,Content-Type,Accept,token,X-Requested-With,device');
    }
    //公共方法文件
    /**
     * 获取头部token
     **/
    public function token(){
        $token = $_SERVER['HTTP_TOKEN'];
        if (!$token){
            return false;
        }
        return $token;
    }
    /**
     * 验证token和查询用户id
     **/
    public function checkToken(){
        $token = $this->token();
        $uid = $_SESSION[$token];
        if (empty($uid)) return false;
        return $uid;
    }
    /**
     * curl请求
     * post
     * */
    public function request_post($url = '', $param = '') {
        if (empty($url) || empty($param)) {
            return false;
        }
        $postUrl = $url;
        $curlPost = $param;
        $curl = curl_init();//初始化curl
        curl_setopt($curl, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($curl, CURLOPT_HEADER, 0);//设置header
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($curl, CURLOPT_POST, 1);//post提交方式
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);// 设置是否检查服务器端的证书
        $data = curl_exec($curl);//运行curl
        curl_close($curl);
        return $data;
    }
    /**
     * 字段 累加
     * $tables 数据表
     * $id 数据id
     * $column 字段
     * $num 累加值
     * */
    public function andone($tables,$id,$column,$num=1){
        $sqlcheck = "select `id`,`".$column."` from  `".$tables."` where `id` =".$id;
        $dataCheck = table_sql($sqlcheck);
        $rows = 0;
        while($row = $dataCheck->fetch_assoc()) {
            $rows = $row[$column];
        }
        $sum = round($rows+$num);
        $sql = "update `".$tables."` set ".$column." = ".$sum." where `id` =".$id;
        table_sql($sql);
        return true;
    }
}
