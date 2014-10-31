<!--功能导航ui-->

<!--according-->



<div id=accordion class=easyui-accordion >

    <div title="用户管理">
        <a class=easyui-menubutton menu="#mccUserSelect" >用户查询</a><br>
        <a class=easyui-menubutton menu="#selectB" >用户冻结</a><br>
        <a class=easyui-menubutton menu="#selectC" >用户核销</a><br>
    </div>

    <div title="栏目管理">
        <a class=easyui-menubutton menu="#mccCatShow" >栏目查看</a><br>
        <a class=easyui-menubutton menu="#mccCatAddModify" >栏目增改</a><br>
        <a class=easyui-menubutton menu="#mccCatRemove" >栏目删除</a><br>
    </div>

    <div title="文章管理">
    222222
    </div>

</div>



<!--begin: 用户管理的菜单按钮的内容-->

    <!--用户查询-->
    <!--mc:"menu content container"-->
    <div id=mccUserSelect >    
        <a class="easyui-linkbutton" id="mccUserSelect_zongbiao">总表</a>
        <a class="easyui-linkbutton" >22</a>
    </div>

    <!--用户冻结-->
    <div class id=selectB >
        <a class="easyui-linkbutton" style="width:120px" >11</a>
        <a class="easyui-linkbutton" >22</a>
    </div>

    <!--用户核销-->
    <div id=selectC >
        <a class="easyui-linkbutton" >11</a>
    </div>
<!--end:用户管理的菜单按钮的内容-->



<!--begin: 栏目管理的菜单按钮的内容-->

    <!--栏目查询-->
    <!--mc:"menu content container"-->
    <div id=mccCatShow >    
        <a class="easyui-linkbutton " id="mccCatShow_list">列表显示</a>
        <a class="easyui-linkbutton" id="mccCatShow_tree">树形显示</a>
    </div>

    <!--栏目增改-->
    <div  id=mccCatAddModify >
        <a class="easyui-linkbutton" id="mccCatAddModify_add" >栏目增加</a>
        <a class="easyui-linkbutton" id="mccCatAddModify_modify" >栏目修改</a>
    </div>

    <!--栏目移除-->
    <div id=mccCatRemove >
        <a class="easyui-linkbutton" id="mccCatRemove_remove">栏目移除</a>
    </div>
<!--end:栏目管理的菜单按钮的内容-->









<script >

    

//为菜单内容的用户选择(linkbutton)添加单击事件处理脚本
    $("#mccUserSelect_zongbiao").click(
        function(){
            $("#regCenter").panel({
                'region':"center",
                'href':"http://localhost/dingxindianqi/index.php/user/listshow"
            });
        }
    );


//为栏目查看(menu)的菜单内容的列表显示(linkbutton)添加单击事件处理脚本
    $("#mccCatShow_list").click(
        function(){
            $("#regCenter").panel({
                'region':"center",
                'href':"http://localhost/dingxindianqi/index.php/category/treenode"
            });
        }
    );









</script>



