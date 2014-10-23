<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8">
</head>

<body>
<form action="<?php echo $host_url?>/index.php/article/add" method="post">

    文章类别<input id="articlecat" name="articlecat" type="text">
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
