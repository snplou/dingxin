<?php

class Category extends CI_Controller{

    var $host_url;

    function __construct(){
        
        parent::__construct();
        $this->load->database();
        $this->load->model("categorymodel","categorymodel");
        $this->host_url="http://localhost/dingxindianqi";
    }



    function index(){

        /*
        $data=array(
            "host_url"=> `$this->host_url,
        );
         */

        echo "category index page";
    }


    function treenode(){

        $id=isset($_POST["id"])?$_POST["id"]:0;
        $query=$this->categorymodel->get_cats_by_pid($id);

        $result=array();
        foreach($query->result_object() as $row){
            $node=array();
            $node["id"]=$row->cat_id;
            $node["text"]= $row->cat_name;  
            $node["state"]=($this->categorymodel->has_child_cats($row->cat_id))? "closed" :"open" ;
            array_push($result,$node);
        }
        echo json_encode($result);
    }




    function datagrid_json(){
        if(!isset($_POST["rows"])||
            !isset($_POST["page"])
        ){ //process a get request
            echo "require post rows and page";
        }else{
            //process a post request
            $rows=$_POST["rows"];
            $page=$_POST["page"];

            $result["total"]=$this->categorymodel->datagrid_total();
            $query=$this->categorymodel->datagrid_rows($rows,$page);
            $rows=array();
            foreach($query->result() as $row ){
                $item=array();
                $item["category_id"]=$row->cat_id;
                $item["category_name"]=$row->cat_name;
                $item["category_pid"]=$row->cat_pid;
                array_push($rows,$item);
            }
            $result["rows"]=$rows;
            echo json_encode($result);
        }
    }




    function listshow(){
        if(!isset($_POST["rows"])||
            !isset($_POST["page"])
        ){
            //process a get request
            $content_array["host_url"]=$this->host_url;
            $this->load->view(
                "category/listshowView",
                $content_array
            );
        }else{
            //process a post requset
        }
    }





    function add(){
        if(!isset($_POST["category_pid"])){
            //porcess a requset with a get method
           $data=array(); 
           $data["host_url"]=$this->host_url;
           $this->load->view(
                "category/addview",
                $data
            );

        }else{
            //process a request with a post method
            $pid=$_POST["category_pid"];
            $name=$_POST["category_name"];
            $ret=$this->categorymodel->add($pid,$name);
            if($ret){
                echo "success";
            }


        }
    }


    function remove(){
        if(!isset($_POST["id"])){
            //process a request with a get mothod
            
            $data=array(
                "host_url"=> $this->host_url,
            );
            $this->load->view(
                "category/removeview",
                $data
            );
        } else{
            $id=$_POST["id"];
            $ret=$this->categorymodel->remove($id);
            
            if($ret){
                echo "succeed";
            }else{
                echo "false";
            }
        }
    }



    function modify(){

        if(!isset($_POST["id"])||!isset($_POST["name"])){

            //process a request with get method
            $data["host_url"]=$this->host_url;
            $this->load->view(
                "category/modifyview",
                $data
            );

        }else{
            //process a request with post method

            $id=$_POST["id"];
            $name=$_POST["name"];
            $ret=$this->categorymodel->modify($id,$name);
            if($ret){
                echo "succeed";
            }else{
                echo "false";
            }
        }
    }







}



?>
