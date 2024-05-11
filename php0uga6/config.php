<?php
/**
 * 数据库配置文件
 * */
function table_sql($sql){
    $host = "localhost";
    $username = "root";
    $passwd = "123456";
    $dbname = "php0uga6";
    $mysqlport = "3306";
    // 创建连接
        // MySQL
    $conn = new \mysqli($host, $username, $passwd, $dbname, $mysqlport);
    $conn->query("SET NAMES 'UTF8'");
    // 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    $result = $conn->query($sql);
    $conn->close();
            return $result;
}
