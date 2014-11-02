<?php

class CategoryModel extends CI_Model{

    var $table;

    function __construct(){
        parent::__construct();
        $this->table="category";
    }


    function get_cats_by_pid($pid){

        $this->db->select("*")->from($this->table)->where("cat_pid",$pid);
        return $this->db->get();
    }




    function has_child_cats($pid){

        $this->db->select("*")->from($this->table)->where("cat_pid",$pid);
        $query=$this->db->get();
        return ($query->num_rows>0)?true:false;
    }



    function datagrid_total(){
        $query=$this->db->
            select("count(*) as count")->
            from($this->table);//todo:加上where条件
        $query=$this->db->get()->result();
        $row=$query[0];
        return $row->count;
    }

    function datagrid_rows($rows=10,$page=1){ 
        $offset=($page-1)*$rows;
        $query=$this->db->get($this->table,$rows,$offset);
        return $query;
    }





    function add($pid,$name){

        if(!isset($pid)||!isset($name)){
            echo "parameters too less";
            return false;
        }else{
            $data=array(
                "cat_pid"=>$pid,
                "cat_name"=>$name,
            );
            //todo:需要校验pid 是否存在
            $this->db->insert($this->table,$data);
            if($this->db->affected_rows()>0){
                return true;
            }
        }
    }




    function remove($id){

        if(!isset($id)){
            echo "parameters too less:id";
            return false;
        }else{
            $this->db->where("cat_id",$id);
            $this->db->delete(
                $this->table
            );
            if($this->db->affected_rows()>0){
                return true;
            }else{
                return false;
            }
        }
    }




    function modify($id,$name){
        if(!isset($id)||!isset($name)){
            echo "parameters too less:id";
            return false;
        }else{
            $data=array(
                "cat_name"=>$name,
            );
            $this->db->where("cat_id",$id);
            $this->db->update($this->table,$data);
            return ($this->db->affected_rows()>0)?true:false;
        }

    } 




}



?>
