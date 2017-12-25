<?php
    //创建连接
    /*
     * $error  获取错误编号，存储错误信息，引用类型值
     * $errstr 存放错误信息
     * 如果超过10秒则自动断开连接
    */
    $fp = fsockopen('localhost',80,$errno,$errstr,10);

    //检测
    if(!$fp){
        echo $errstr;die;
    }

    //拼接http请求报文
    $http = '';
    //请求报文包含三部分：请求行、请求头、请求体

    //请求行
    $http .= "_GET_ /http/server.php HTTP/1.1\r\n"; //请求行包含三个部分：请求方式、请求脚本的绝对路径、协议的版本
    //请求头信息
    $http .= "Host:localhost\r\n";  //协议限定   主机
    //如果请求头完毕，则需要加两遍\R\N
    $http .= "Connection:close\r\n\r\n";    //返回信息后立马断开连接
    //请求体   GET请求不需要请求体，but，post需要

    //发送请求
    fwrite($fp,$http);

    //获取结果
    $res = '';
    //feof检测文件是否到结尾
    while(!feof($fp)){
        $res .= fgets($fp);
    }

    //输出内容
    echo $res;
