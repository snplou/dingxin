<!--功能导航ui-->

<!--according-->



<div id=accordion class=easyui-accordion >

    <div title="用户管理">
        <a class=easyui-menubutton menu="#mccUserSelect" >用户查询</a>
        <a class=easyui-menubutton menu="#selectB" >用户冻结</a>
        <a class=easyui-menubutton menu="#selectC" >用户核销</a>
    </div>

    <div title="文章管理">
    222222
    </div>

    <div title="栏目管理">
    33
    </div>

</div>



<!--begin: 用户管理的菜单按钮的子菜单-->

    <!--用户查询-->
    <!--mc:"menu content container"-->
    <div id=mccUserSelect >    
        <a class="easyui-linkbutton" id="mccUserSelect_zongbiao">总表</a>
        <a class="easyui-linkbutton" >22</a>
        <a class="easyui-linkbutton" >33</a>
    </div>

    <!--用户冻结-->
    <div class id=selectB >
        <a class="easyui-linkbutton" style="width:120px" >11</a>
        <a class="easyui-linkbutton" >22</a>
        <a class="easyui-linkbutton" >33</a>
        <a class="easyui-linkbutton" >44</a>
        <a class="easyui-linkbutton" >55</a>
    </div>

    <!--用户核销-->
    <div id=selectC >
        <a class="easyui-linkbutton" >11</a>
        <a class="easyui-linkbutton" >22</a>
        <a class="easyui-linkbutton" >33</a>
        <a class="easyui-linkbutton" >44</a>
        <a class="easyui-linkbutton" >55</a>
    </div>
<!--end:用户管理的菜单按钮的子菜单-->



<script >

    

    $("#mccUserSelect_zongbiao").click(
        function(){
            $("#regCenter").panel({
                'region':"center",
                'href':"http://localhost/dingxindianqi/index.php/user/listshow"
            });
        }
    );
    $.parser.parse($("$mccUserSelect_zongbiao").parent());










</script>



