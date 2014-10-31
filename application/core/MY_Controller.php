<?php

class MY_Controller extends CI_Controller{




    function datagrid_json(){

        if(!isset($_POST["rows"])|| !isset($_POST["page"])
        ){
            echo "parameters too less: rows and page must be provided";
            return false;
        }else{
            $dg[$rows]=$_POST["rows"];
            $dg[$page]=$_POST["page"];
            return $dg;
        }
    }



    function tree_json(){
    }

}




?>
