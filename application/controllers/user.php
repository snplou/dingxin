<?php

class User extends CI_Controller{



    var $host_url;

    function __construct(){

        parent::__construct();

        //todo:验证是否系统级管理员
        //
        //todo:其他初始化
        $this->host_url="http://localhost/dingxindianqi";
        $this->load->database();
        $this->load->model(
            "userModel",
            "usermodel"
        );
    }




    function index(){
        echo "user index page";
    }


    function listshow(){
        $array=array(
            "host_url"=>$this->host_url,
        );
        $this->load->view(
            "user/listshow",
            $array
        );
    }


    function datagrid_json(){

        //有必要把校验、赋值提取到父类的datagrid_json中去
        if(!isset($_POST["rows"])||
            !isset($_POST["page"])
        ){
            echo "parameters too less: rows and page must be provided";
        }else{
            $rows=$_POST["rows"];
            $page=$_POST["page"];

            $query=$this->usermodel->datagrid_rows($rows,$page);

            $result["total"]=$this->usermodel->datagrid_total();
            $mat=array();
            foreach($query->result() as $query_row){
                $mat_row["username"]=$query_row->username;
                $mat_row["email"]=$query_row->email;
                $mat_row["create_date"]=$query_row->create_time;
                $mat_row["frozen"]=$query_row->frozen;
                array_push($mat,$mat_row);
            }
            $result["rows"]=$mat;
            echo json_encode($result);


            
        }

    }



}




?>
