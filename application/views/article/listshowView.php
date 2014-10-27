<html>

<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="http://localhost/dingxindianqi/jeasyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="http://localhost/dingxindianqi/jeasyui/themes/icon.css">
<script type="text/javascript" src="http://localhost/dingxindianqi/jeasyui/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/dingxindianqi/jeasyui/jquery.easyui.min.js"></script>

</head>
<body>

<table id="dgTD" class="easyui-datagrid" 
    url="<?php echo $host_url ?>/index.php/article/listshow?catid=<?php echo $catid ?>" 
    pagination=true
 >
    <thead>
        <tr>
            <th field='article_name'>title </th>
            <th field='article_date'>date </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>



</body>

</html>
