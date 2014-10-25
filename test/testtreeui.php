<html>
<head>

<meta charset=utf-8>

<link rel="stylesheet" type="text/css" href="http://localhost/dingxindianqi/jeasyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="http://localhost/dingxindianqi/jeasyui/themes/icon.css">
<script type="text/javascript" src="http://localhost/dingxindianqi/jeasyui/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/dingxindianqi/jeasyui/jquery.easyui.min.js"></script>

<title> 测试easyui-tree </title>

</head>


<body>

<div  class="easyui-layout" style="width:928px;height:600px">

    <div id="northreg" region='north' split:true title="菜单导航"> </div>
    <div id="wesetreg" region='west' split:true title='导航'  style="width:30%">
        <ul id="navtree" class="easyui-tree" > </ul>
    </div>

    <div id="centreg" region='center' split:true title='主页' > </div>
    <div id="southreg" region='south' split:true title="页脚"> </div>


</div >



<script >
    $("#navtree").tree(
        {
            url:"http://localhost/dingxindianqi/index.php/category/treenode",
            onSelect:function(node){
                var content_url;
                    //listshow
                content_url="http://localhost/dingxindianqi/index.php/article/show?catid="+node.id;
                $("#centreg").load(
                    content_url
                );
            }    
        }
    );
</script>

</body>
</html>
