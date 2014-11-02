<table class=easyui-datagrid id="dgCategory"> 

    <thead>
        <tr>
            <th field='category_id'>id </th>
            <th field='category_name'>名称 </th>
            <th field='category_pid'>pid </th>
        </tr>
    </thead>

    <tbody> </tbody>

</table>

<script>
(function(){
    
    
    
    $("#dgCategory").datagrid({
        url:"<?php echo $host_url ?>/index.php/category/datagrid_json" ,
        pagination:true,
        fit:true,
        singleselect:true,
        striped:true,
        rownumbers:true,
    }); 
    $("#dgCategory").datagrid("getPager").pagination( {
        onSelectPage:function(pageNumber,pageSize){
            alert(pageNumber,pageSize);
        },
    });
    
    
    
    
    
})();
</script>


</body>

</html>
