<?php

class Article extends CI_Controller{

    var $host_url;

    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->host_url="http://localhost/dingxindianqi";
        $this->load->model("articleModel","articlemodel");

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
            $ret=$this->articlemodel->remove($id);
            print_r($ret);
        }
    }


    function modify(){

        

    }

function listshow(){ 

        if(!isset($_POST["catid"])){
            //

            $data=array(
                $query= $this->db->get(
                    $this->articlemodel->table
                ),
                "query"=>$query,
            );
            $this->load->view(
                "article/listshowView",
                $data
            );
            
        }else{
            //list show article with a catid
            //
        }

    }


    function detailshow(){

    }



}



?>
