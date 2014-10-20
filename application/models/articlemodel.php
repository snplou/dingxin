<?php

class ArticleModel extends CI_Model{

    var $table="article";

    function __construct(){

        parent::__construct();
        $this->load->database();
    }

    function index(){

    }

    function add($name,$author,$note="",$content,$istop=""){

        if($note!==""){
            $row["article_note"]=$note;
        }
        if($istop!==""){
            $row["article_istop"]=$istop;
        }

        $row=array(
            "article_name"=>$name,
            "article_author"=>"",
            //"article_note"=>$note,
            //"article_date"=>date(),
            "article_content"=>$content,
            "article_istop"=>1,
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

    function listshow(){

    }

    function detailshow(){

    }


}




?>
