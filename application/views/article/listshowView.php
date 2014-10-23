<?php


echo "<table border=2px>";




echo "<thead>";
echo "<tr>";
foreach($query->list_fields() as $field){
    echo "<th>";
    echo $field;
    echo "</th>";

}
echo "</tr>";
echo "</thead>";





echo "<tbody>";
foreach($query->result_array() as $row){
    echo "<tr>";
    //print_r($row);
    
    foreach($row as $field){
        echo "<td>";
        echo $field; //todo:需要对pk字段设置detailview的超链接
        echo "</td>";
    }
    echo "</tr>";

}
echo "</tbody>";




echo "</table>";




?>

