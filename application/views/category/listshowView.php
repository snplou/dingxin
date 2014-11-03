<!--datagrid-->
<table  id="dgCategory" > </table>

<script>
(function(){
    
    
    
    $("#dgCategory").datagrid({
        url:"<?php echo $host_url ?>/index.php/category/datagrid_json" ,
        pagination:true,
        fit:true,
        singleselect:true,
        striped:true,
        rownumbers:true,
        columns:[
            [
                {field:'category_id',title:'id',editor:'text'},
                {field:'category_name',title:'栏目',},
                {field:'category_pid',title:'pid',},
            ],
        ]
    }); 
    
    
    
    
    
})();
</script>


</body>

</html>
