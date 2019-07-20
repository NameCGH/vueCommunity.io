<?php
    header("Content-Type:text/html;charset=utf-8;");
    header("Access-Control-Allow-Origin:*");
    
    // 获取get形式传递的参数action，第一种方式在没有传递action键时会提示错误
    // $action = $_GET['action'] ? $_GET['action'] : "index";
    
    // 获取需要获取的数据类型
    if(!empty($_POST['action'])){
        $action = $_POST['action'];
    }
    else{
        $action = "index";
    }
    // 获取需要获取的数据页数
    if(!empty($_POST['page'])){
        $page = $_POST['page'];
    }
    else{
        $page = 1;
    }
    // if($action == "frame"){
        // 打开文件--方式一
        $filedata = fopen("./data.json","r") or exit("Unable to open file!");
        $filecontent = fread($filedata,filesize("data.json"));
        // $data = json_decode($filecontent,true)['frame'];
        $data = json_decode($filecontent,true)[$action];
        fclose($filedata);
        
        $length = sizeof($data);
        if(!$length){
            echo json_encode(array("static" => 0));
            die;
        }
        $returndata = array_slice($data,($page - 1) * 25,25);
        // 返回数据
        echo json_encode(array("static" => 1, "datalength" => ceil($length/25), "data" => $returndata));
        die;
    // }

    // php返回json数据使用json_encode方法返回关联数据
    // $data = array( array('success' => 111, 'error_code' => 222),array('datalist' => 333));
    // echo json_encode(array(1,$data));
?>
