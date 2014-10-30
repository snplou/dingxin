<html>
<head>
    <meta charset=utf-8>

    <!--todo: 把绝对路径改成相对路径  -->
    <link rel="stylesheet" type="text/css" href="http://localhost/dingxindianqi/jeasyui/themes/metro/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/dingxindianqi/jeasyui/themes/icon.css">
    <script type="text/javascript" src="http://localhost/dingxindianqi/jeasyui/jquery.min.js"></script>
    <script type="text/javascript" src="http://localhost/dingxindianqi/jeasyui/jquery.easyui.min.js"></script>
</head>
<body>
    <table class="easyui-datagrid" id="user-datagrid">
    <thead>
        <tr>
            <th field='username'>用户名 </th>
            <th field='email'> email </th>
            <th field='create_date'> 创建时间 </th>
            <th field='frozen'> 冻结状态 </th>
        </tr>
    </thead>
    </table>

    <script>
    //匿名空间
    (function(){



        $("#user-datagrid").datagrid({
            columns:[[
                {field:"username",title:"用户名"},
                {field:"email",title:"email"},
                {field:"create_date",title:"创建时间"},
                {
                    field:"frozen",
                    title:"冻结状态",
                    editor:{
                        type:"textbox",
                    } 
                },
            ]],
            url:"<?php echo $host_url?>/index.php/user/datagrid_json",    //url to retreive datagrid 
            pagination:true,
            straped:true,
            fit:true,
            sortName:"username",
            rownumbers:true,
        });




        

    })();

    </script>
</body>

</html>
