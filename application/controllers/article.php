<?php

class Article extends CI_Controller{

    var $host_url;

    function __construct(){
        parent::__construct();
        $this->host_url="http://localhost/dingxindianqi";
    }

    function index(){
        echo "article controller index"; 

    }


    function add(){

        if(!isset($_POST["articlecontent"]) || 
            !isset($_POST["articletitle"])  ||
            !isset($_POST["articlecat"])
        ){
            $data["host_url"]=$this->host_url;
            $this->load->view(
                "article/addView",
                $data
            );

        }else{
            $content=$_POST["articlecontent"];
            $title=$_POST["articletitle"];
            $cat=$_POST["articlecat"];
            //$date=date();
            $author="1";

            $this->load->model("articleModel","articlemodel");

            //add($name,$author,$note="",$content,$istop="")
            $ret=$this->articlemodel->
                add($title,$author,NULL,$content,1,14);
            if($ret){
                echo "article added";
            }
        }
    }

    function remove(){

        if(!isset($_POST["id"])){
            $data["host_url"]=$this->host_url;
            $this->load->view(
                "article/removeView",
                $data
            );

        }else{
            $id=$_POST["id"];
            $this->load->model("articleModel","articlemodel");
            $ret=$this->articlemodel->remove($id);
            print_r($ret);
        }
    }


    function modify(){

        

    }


    function listshow(){

        if(!isset($_POST["catid"])){
            //
            
        }else{
            //list show article with a catid
            $data=array(
                "host_url"=>"",
            );
            $this->load->view(
                "article/listshowView",
                $data
            );
        }

    }


    function detailshow(){

    }



}



?>
