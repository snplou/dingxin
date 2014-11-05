<!--功能导航ui-->

<!--according-->



<div id=accordion class=easyui-accordion >

    <div title="用户管理">
        <a class=easyui-menubutton menu="#mccUserSelect" >用户查询</a>
        <a class=easyui-menubutton menu="#selectB" >用户冻结</a>
        <a class=easyui-menubutton menu="#selectC" >用户核销</a>
    </div>

    <div title="栏目管理">
        <a class="easyui-linkbutton " id="lbtnCategoryListShow">列表显示</a>
        <a class="easyui-linkbutton" id="lbtnCategoryTreeShow">树形显示</a>
    </div>

    <div title="文章管理">
        <a class=easyui-linkbutton id="lbtnArticleListShow">  列表查看  </a>
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


//为栏目查看列表显示(linkbutton)添加单击事件处理脚本
    $("#lbtnCategoryListShow").click(
        function(){
            $("#regCenter").panel({
                'region':"center",
                'href':"http://localhost/dingxindianqi/index.php/category/datagrid_show"
            });
        }
    );



//为文章列表显示(linkbutton)添加单击事件处理脚本
    $("#lbtnArticleListShow").click(
        function(){
            $("#regCenter").panel({
                'region':"center",
                'href':"http://localhost/dingxindianqi/index.php/article/show?id=14"
            });
        }
    );







</script>



