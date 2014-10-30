<?php


class Backend_index extends CI_Controller{



    var $host_url;

    function __construct(){
        parent::__construct();
        $this->host_url="http://localhost/dingxindianqi";
        //todo:验证用户登录状态
        //todo 验证用户权限
    }


    //处理后台管理界面的首页总体布局,
    //各区块内部利用服务端嵌套技术和客户端嵌套技术来加载不同模块
    function index(){

        $array=array(
            "host_url"=>$this->host_url,
        );

        $this->load->view(
            "backend/backend_index",
            $array
        );

    }

    //首次登录显示在layout的center中的欢迎页面
    function welecome(){
        $this->load->view(
            "backend/welcome_to_admin"
        );
    }





}



?>

