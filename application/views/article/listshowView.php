<table id="dgTD" class="easyui-datagrid" >
    <thead>
        <tr>
            <th field='article_name'>title </th>
            <th field='article_date'>date </th>
        </tr>
    </thead>

    <tbody>
    </tbody>

</table>

<script>
//匿名空间
(function(){



    $("#dgTD").datagrid({
        url:"<?php echo $host_url ?>/index.php/article/listshow?catid=<?php echo $catid ?>" ,
        pagination:true,
        fit:true,
        singleselect:true,
    });




})();
</script>
