<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8">

<link rel="stylesheet" type="text/css" href="http://localhost/dingxindianqi/jeasyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="http://localhost/dingxindianqi/jeasyui/themes/icon.css">
<script type="text/javascript" src="http://localhost/dingxindianqi/jeasyui/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/dingxindianqi/jeasyui/jquery.easyui.min.js"></script>


</head>

<body>
<form action="<?php echo $host_url?>/index.php/article/add" method="post">

    文章类别<input class="easyui-combotree" 
                    id="articlecategory" 
                    name="articlecat" 
                    url="http://localhost/dingxindianqi/index.php/category/treenode" >

    文章标题<input id="articletitle" name="articletitle" type="text">

    <script id="ueditorcontainer" name="articlecontent" type="text/plain" ></script>

    <input type="submit" value="提交">

</form>

<script type="text/javascript" src="<?php echo $host_url?>/ueditor/ueditor.config.js" ></script>
<script type="text/javascript" src="<?php echo $host_url?>/ueditor/ueditor.all.js" > </script>
<script type="text/javascript">
    var ue=UE.getEditor('ueditorcontainer');
</script>

</body>

</html>
