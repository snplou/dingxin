<?php


class UserModel extends CI_Model{


    var $user;
    function __construct(){
        $this->dbtable="user";
    }




    function datagrid_rows($rows,$page){

        $offset=($page-1)*$rows;

        $query=$this->db->get($this->dbtable,$rows,$offset);
        return ($query->num_rows()>0)?$query:false;
    }

    function datagrid_total(){
        $this->db
            ->select("count(*) as count")
            ->from($this->dbtable);
        $rows=$this->db->get()->result();
        return $rows[0]->count ;
    }




}



?>
