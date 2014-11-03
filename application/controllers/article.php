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



    //echo json for datagrid
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
