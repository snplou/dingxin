<?php

class ArticleModel extends CI_Model{

    var $table="article";

    function __construct(){

        parent::__construct();
        $this->load->database();
    }

    function index(){

    }

    function add($name,$author,$note="",$content,$istop="",$cat){

        if($note!==""){
            $row["article_note"]=$note;
        }
        if($istop!==""){
            $row["article_istop"]=$istop;
        }

        $row=array(
            "article_name"=>$name,
            "article_author"=>$author,
            //"article_date"=>date(),
            "article_note"=>$note,
            "article_content"=>$content,
            "article_istop"=>0,
            "article_cat"=>$cat,
        );

        $this->db->insert($this->table,$row);
        return ($this->db->affected_rows()>0)?true:false;


    }


    function remove($id=""){

        if($id==""){
            exit("must provide parameter:$id");
        }else{

            $this->db->where("article_id",$id);
            $this->db->delete($this->table);
            return ($this->db->affected_rows()>0)?true:false;

        }
    }


    function modify(){

    }

    function listshow($catid=1){

        $this->db
            ->select("article_id,article_name,article_content,article_date") 
            ->from($this->table)
            ->where("article_cat",$catid);
        return  $this->db->get();

    }

    function detailshow($articleid=1){

        $this->db
            ->select("*") 
            ->from($this->table)
            ->where("article_id",$articleid);
        return  $this->db->get();

    }


}




?>
