<?php


class UserModel extends CI_Model{


    var $user;
    function __construct(){
        $this->modeltable="user";
    }




    function datagrid_json($rows,$page){

        $offset=($page-1)*$rows;

        $query=$this->db->get($this->modeltable,$rows,$offset);
        return ($query->num_rows()>0)?$query:false;
    }



}



?>
