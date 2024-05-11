<?php
session_start();
class ApiController extends CommonController
{
	public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Headers:Origin,Content-Type,Accept,token,X-Requested-With,device');
    }
    /**
     * 上传
     * post
     */
    public function upload(){
        set_time_limit(0);
        // 允许上传的图片后缀
        //$allowedExts = array("gif", "jpeg", "jpg", "png", "docx", "doc", "zip", "rar", "gz", "xlsx", "xlx", "ppt", "pptx", "txt", "bmp");
        header('Content-Type:application/json');
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);     // 获取文件后缀名
		// && in_array($extension, $allowedExts)
        if ($_FILES["file"]["error"] > 0) {
            exit("错误：: " . $_FILES["file"]["error"] . "<br>");
        }else{
            if (file_exists("upload/" . $_FILES["file"]["name"]))
            {
                exit($_FILES["file"]["name"] . " 文件已经存在。 ");
            }else{
                // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                $fileNames = time().".".$extension;
                move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $fileNames);
            }
                        exit(json_encode(['code'=>0,'file'=>$fileNames,'msg'=>"上传成功！"]));
        }

    }
    /**
     * 下载
     * get
     */
    public function download()
    {
        $fileName = $_GET['fileName'];
        header('location:http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $fileName);
    }
    /**
     * 获取某表的某个字段列表接口
     * get
     * $level 等级
     * $parent 列值
     */
    public function option($tablesName,$columnName,$level=false,$parent=false){
            $where = "";
            if ($level!=false){
                $where = "`level=`".$level." and `parent` = ".$parent;
            }
            $sql = "select `".$columnName."` from `".$tablesName."`".$where;
            $result = table_sql($sql);
            $arrays = array();
            if ($result->num_rows > 0) {
                // 输出数据
                while($row = $result->fetch_assoc()) {
                    array_push($arrays,$row);
                }
                $array = array_column($arrays,$columnName);
            } else {
                $array = 0;//0 结果
            }
            exit(json_encode(['code'=>0,'data'=>$array]));
        }
    /**
     * 根据option字段值获取某表的单行记录接口
     * get
     */
    public function follow($tablesName,$columnName){
        $columnValue = isset($_GET['columnValue'])?$_GET['columnValue']:"";
        $sql = "select * from `".$tablesName."` where ".$columnName." = '".$columnValue."'";
        $result = table_sql($sql);
        $arrays = "";
        if ($result->num_rows > 0) {
            // 输出数据
            while($row = $result->fetch_assoc()) {
                $arrays = $row;
            }
        } else {
            $arrays = 0;//0 结果
        }
        exit(json_encode(['code'=>0,'data'=>$arrays]));
    }
    /**
     * 根据主键id修改table表的sfsh状态接口
     * post
     */
    public function sh($tablesName){
        $id = isset($_POST['id'])?$_POST['id']:"";
        $sfsh = isset($_POST['sfsh'])?$_POST['sfsh']:"";
        if ($sfsh=="是"){
            $vlaue = "否";
        }else{
            $vlaue = "是";
        }
        $sql = "update `".$tablesName."` SET `sfsh`=".$vlaue." where (`id`=".$id.")";
        $result = table_sql($sql);
        exit(json_encode(['code'=>0]));
    }
    /**
     * 获取需要提醒的记录数接口
     * get
     */
    public function remind($tablesName,$columnName,$type){
        $remindStart = isset($_GET['remindstart']) ? $_GET['remindstart'] : null;
        $remindEnd = isset($_GET['remindend']) ? $_GET['remindend'] : null;
        if ($type == 1){//数字
            if ($remindStart && $remindEnd){
                $sql = "select * from ".$tablesName." where ".$columnName."<='".$remindEnd."' and ".$columnName.">='".$remindStart."'";
            }elseif($remindStart){
                $sql = "select * from ".$tablesName." where ".$columnName.">='".$remindStart."'";
            }elseif($remindEnd){
                $sql = "select * from ".$tablesName." where ".$columnName."<='".$remindEnd."'";
            }
        }else{
            if ($remindStart && $remindEnd){
                $sql = "select * from ".$tablesName." where ".$columnName."<='".date("Y-m-d",strtotime("+".$remindEnd." day"))."' and ".$columnName.">='".date("Y-m-d",strtotime("+".$remindStart." day"))."'";
            }elseif($remindStart){
                $sql = "select * from ".$tablesName." where ".$columnName.">='".date("Y-m-d",strtotime("+".$remindStart." day"))."'";
            }elseif($remindEnd){
                $sql = "select * from ".$tablesName." where ".$columnName."<='".date("Y-m-d",strtotime("+".$remindEnd." day"))."'";
            }
            
        }
        $result = table_sql($sql);
        exit(json_encode(['code'=> 0 ,'count' => $result->num_rows]));
    }
    /**
     * 计算规则接口
     * get
     */
    public function cal($tablesName,$columnName){
        $sql = "select max(".$columnName.") as max,min(".$columnName.") as min,avg(".$columnName.") as avg,sum(".$columnName.") as sum from `".$tablesName."`";
        $result = table_sql($sql);
        $sum = $max = $avg = $min = "";
        if ($result->num_rows > 0) {
            // 输出数据
            while($row = $result->fetch_assoc()) {
                $max = $row['max'];
                $min = $row['min'];
                $avg = $row['avg'];
                $sum = $row['sum'];
            }
        } else {
            $max = 0;
            $min = 0;
            $avg = 0;
            $sum = 0;//0 结果
        }
        exit(json_encode([
            'code'=>0,
            'data'=>[
                'max'=>$max,
                'min'=>$min,
                'avg'=>$avg,
                'sum'=>$sum,
            ]
        ]));
    }
    /**
     * 类别统计接口
     *
     * */
    public function group($tablesName,$columnName){
        $sql = "SELECT ".$columnName.",count(".$columnName.") as total FROM ".$tablesName." GROUP BY ".$columnName." ORDER BY total desc";
        $result = table_sql($sql);
        if ($result->num_rows > 0) {
            // 输出数据
            $total = array();
            while($row = $result->fetch_assoc()) {
                array_push($total,array('total' => $row['total'],$columnName => $row[$columnName]));
            }
        }
        exit(json_encode(['code'=>0,'data'=>$total]));
    }
    /**
     * 按值统计接口
     * tableName	String	表名
     * xColumnName String  列名
     * yColumnName String  列名
     **/
    public function value($tableName,$xColumnName,$yColumnName){
        $sql = "SELECT ".$xColumnName.",sum(".$yColumnName.") total FROM ".$tableName." group by ".$xColumnName;
        $result = table_sql($sql);
        if ($result->num_rows > 0) {
            // 输出数据
            $total = array();
            while($row = $result->fetch_assoc()) {
                array_push($total,array('total' => intval($row['total']),$xColumnName => $row[$xColumnName]));
            }
        }
        exit(json_encode(['code'=>0,'data'=>$total]));
    }
        }