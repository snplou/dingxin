<?php

class Article extends CI_Controller{

    var $host_url;

    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library("table");
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
                add($title,$author,NULL,$content,1,$cat);
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

    function show(){ 

        $catid=(isset($_GET["catid"]))?
            intval($_GET["catid"]):1;
        $query=$this->articlemodel->listshow($catid);
        
        if($query->num_rows()>1){
            //listshow
            $this->load->library("table");
            echo $this->table->generate($query->result_array());

        } elseif($query->num_rows()==1){
            //detailshow
            $row=$query->result();
            echo $row[0]->article_content;
        }else{
            echo "welcome";
        }



    }


    function detailshow(){

        $articleid=(isset($_GET["articleid"]))?
            inval($_GET["articleid"]):1;
        $query=$this->articlemodel->detailshow($articleid);
        $rows=$query->result();
        echo($rows[0]->article_content);

    }



}



?>
