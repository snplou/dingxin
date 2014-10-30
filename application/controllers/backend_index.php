<?php


class Backend_index extends CI_Controller{



    var $host_url;

    function __construct(){
        parent::__construct();
        $this->host_url="http://localhost/dingxindianqi";
        //todo:验证用户登录状态
        //todo 验证用户权限
    }


    function index(){

        $array=array(
            "host_url"=>$this->host_url,
        );

        $this->load->view(
            "backend/backend_index",
            $array
        );

    }





}



?>

