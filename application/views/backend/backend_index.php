<html>
<head>

    <meta charset=utf-8>

    <link rel="stylesheet" type="text/css" href="<?php echo $host_url?>/jeasyui/themes/metro/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $host_url?>/jeasyui/themes/icon.css">
    <script type="text/javascript" src="<?php echo $host_url?>/jeasyui/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $host_url?>/jeasyui/jquery.easyui.min.js"></script>

    <title >
        网站后台管理系统
    </title >

</head>
<body class=easyui-layout>

<div region=north >
    <!--以后加点logo-->
    后台管理系统
</div>

<div id="west" region='west' style="width:30%;" >
    <!--服务端嵌套:func_nav导航UI-->
    <?php include "func_nav.php"?>
</div>

<div region='center' id=regCenter href="<?php echo $host_url;?>/index.php/backend_index/welecome">
    <!--ajax动态请求:具体内容-->
</div>


<div region=south >
    <?php include "footer.php"?>
</div>

</body>



<!--匿名函数空间-->
<script>
(function(){







})();

</script>
