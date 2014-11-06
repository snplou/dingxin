<html>
<head>
</head>
<body>

<!--datagrid-->
<table id="dgArticle" title="文章" > </table>


<!--datagrid的工具栏-->
<div id="dgtoolbarArticle" >
   <!-- 此处不予放置此按钮
    <a class=easyui-linkbutton id="lbtnArticleAddRow" iconCls=icon-add >新增</a>
    <a class=easyui-linkbutton id="lbtnArticleModifyRow" iconCls=icon-edit>编辑</a>
    -->
    <a class=easyui-linkbutton id="lbtnArticleRemoveRow" iconCls=icon-remove>删除</a>
</div>


<!--Add和modify操作的对话框-->
<div id="dlgCRUD_Article" > </div>





<script>
(function(){


///////////////////////////////////////////////////////////
    //基础配置
///////////////////////////////////////////////////////////

    //DOM_ID系列常量
    var DLG_CRUD_DOM_ID="dlgCRUD_Article",    //dialog
        DG_CRUD_DOM_ID="dgArticle",    //datagrid
        LBTN_ADDROW_DOM_ID="lbtnArticleAddRow",    //linkbutton 增加一行
        LBTN_MODIFYROW_DOM_ID="lbtnArticleModifyRow",    //linkbutton 修改一行
        LBTN_REMOVEROW_DOM_ID="lbtnArticleRemoveRow";    //linkbutton 删除一行

    //URL to CRUD
    var URL_TO_READ="<?php echo $host_url ?>/index.php/article/datagrid_json",   //url to retrieve data
        URL_TO_ADD= "<?php echo $host_url?>/index.php/article/add",     //url to add 
        URL_TO_MODIFY="<?php echo $host_url?>/index.php/article/modify",    //url to modify 
        URL_TO_REMOVE="<?php echo $host_url?>/index.php/article/remove";    //url to remove 
        
    

    //用于构造datagrid 的JSON对象
    var oDgCrud={
        url:URL_TO_READ ,    //读取json数据的服务器地址
        pagination:true,    //是否分页
        fit:true,
        singleSelect:true,    //单行选择 
        striped:true,    //条纹显示
        rownumbers:false,    //是否显示行号
        toolbar:"#dgtoolbarArticle",  //工具栏
        columns:[    //多行表头组成的数组
            [
                {field:'article_id',title:'文章id'},
                {field:'article_name',title:'文章标题',editor:{type:'text'}},
                {field:'article_author',title:'文章作者',editor:{type:'text'}},
                {field:'article_cat',title:'文章类别',editor:{type:'text'}},
                {field:'article_date',title:'发布日期',editor:{type:'text'}},
            ],
        ],
        idField:"article_id",    //id 字段
    }; 
    

    //用于构造dialog的JSON对象
    var oDlgCrud={ 
        closed:true ,    //初始处于关闭状态
        resizbale:true,     //可调整对话框大小
        width:"560px",     //宽度
        buttons:[          //下部按钮
            { text:"确定" ,iconCls:"icon-ok", handler:btnInCrudDiglogSave },
            { text:"取消" ,iconCls:"icon-cancel", handler:btnInCrudDiglogCancel },
        ],
    };

    
///////////////////////////////////////////////////////////
    //生成控件操作
/////////////////////////////////////////////////////////////

<?php include "/var/www/dingxindianqi/application/views/datagrid_js_func/datagrid_crud.js.php" ?>











})();
</script>


</body>

</html>
