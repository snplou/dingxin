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

        if(!isset($_POST["article_content"]) || 
            !isset($_POST["article_name"])  ||
            !isset($_POST["article_cat"])
        ){
            $data["host_url"]=$this->host_url;
            $this->load->view(
                "article/addView",
                $data
            );

        }else{
            $content=$_POST["article_content"]; 
            $title=$_POST["article_name"];
            $cat=$_POST["article_cat"];
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

        if(!isset($_POST["article_id"])){
            $data["host_url"]=$this->host_url;
            $this->load->view(
                "article/removeView",
                $data
            );

        }else{
            $id=$_POST["article_id"];
            $ret=$this->articlemodel->remove($id);
            if($ret){
                echo "success";
            }else{
                echo "fail";
            }
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
            $data_array["host_url"]=$this->host_url;
            $data_array["catid"]=$catid;

            $this->load->view(
                "article/listshowView",
                $data_array
            );

        } elseif($query->num_rows()==1){
            //detailshow
            $row=$query->result();
            echo $row[0]->article_content;
        }else{
            //show nothing
            echo "welcome.none";
        }

    }


    function detailshow(){

        $articleid=(isset($_GET["articleid"]))?
            inval($_GET["articleid"]):1;
        $query=$this->articlemodel->detailshow($articleid);
        $rows=$query->result();
        echo($rows[0]->article_content);

    }

    function datagrid_json(){

        if( !isset($_POST['page'])||
            !isset($_POST['rows'])
        ){
            echo "parameters less:page ,rows must be provided";
        }else{
            $page=$_POST['page'];
            $rows=$_POST['rows'];

            $result=array();
            $result['total']=$this->articlemodel->datagrid_total();
            $query=$this->articlemodel->datagrid_rows($page,$rows);
            $rows=array();
            foreach($query->result() as $row){
                $item=array();
                $item["article_id"]=$row->article_id;
                $item["article_name"]=$row->article_name;
                $item["article_author"]=$row->article_author;
                $item["article_date"]=$row->article_date;
                array_push($rows,$item);
            };
            $result["rows"]=$rows;
            echo json_encode($result);
        }

    }



    function datagrid_show(){

        if(!isset($_POST["rows"])||
            !isset($_POST["page"])
        ){
            //process a get request
            $content_array["host_url"]=$this->host_url;
            $this->load->view(
                "article/datagrid_showView",
                $content_array
            );
        }else{
            //process a post requset
        }
    }





    function listshow(){

        
        if( !isset($_GET['catid'])||
            !isset($_POST['page'])||
            !isset($_POST['rows'])

        ){
            echo $_GET["catid"]."<hr>";
            echo "parameters less:page ,rows must be provided";
        }else{
            $catid=intval($_GET["catid"]);
            $page=$_POST['page'];
            $rows=$_POST['rows'];

            $result=array();
            $result['total']=$this->articlemodel->datagrid_total($catid);


            $query=$this->articlemodel->listshow($catid,$page,$rows);

            /*  generate html table
            $this->load->library('table');
            echo $this->table->generate($query);
             */

            //echo json for datagrid
            $rs_array=array();
            foreach($query->result() as $row){
                $item["article_name"]=$row->article_name;
                $item["article_date"]=$row->article_date;
                array_push($rs_array,$item);
            };
            $result["rows"]=$rs_array;
            echo json_encode($result);
        }

    }


}



?>
