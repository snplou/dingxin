<!--datagrid-->
<table  id="dgCategory" title="栏目"> </table>


<!--datagrid的工具栏-->
<div id="dgtoolbarCategory" >
    <a class=easyui-linkbutton id="lbtnCategoryAddRow" iconCls=icon-add >新增</a>
    <a class=easyui-linkbutton id="lbtnCategoryUpdateRow" iconCls=icon-edit>编辑</a>
    <a class=easyui-linkbutton id="lbtnCategoryRemoveRow" iconCls=icon-remove>删除</a>
</div>


<!--Add和Update操作的对话框-->
<div id="dlgCRUD_Category" > </div>





<script>
(function(){


///////////////////////////////////////////////////////////
    //基础配置
///////////////////////////////////////////////////////////

    //DOM_ID系列常量
    var DLG_CRUD_DOM_ID="dlgCRUD_Category",    //dialog
        DG_CRUD_DOM_ID="dgCategory",    //datagrid
        LBTN_ADDROW_DOM_ID="lbtnCategoryAddRow",    //linkbutton
        LBTN_UPDATEROW_DOM_ID="lbtnCategoryUpdateRow",    //linkbutton
        LBTN_REMOVEROW_DOM_ID="lbtnCategoryRemoveRow";    //linkbutton

    //URL to CRUD
    var URL_TO_READ="<?php echo $host_url ?>/index.php/category/datagrid_json",   //url to retrieve data
        URL_TO_ADD= "<?php echo $host_url?>/index.php/category/add",     //url to add 
        URL_TO_UPDATE="",    //url to update 
        URL_TO_REMOVE="<?php echo $host_url?>/index.php/category/remove";    //url to remove 
        
    

    //用于构造datagrid 的JSON对象
    var oDgCrud={
        url:URL_TO_READ ,    //读取json数据的服务器地址
        pagination:true,    //是否分页
        fit:true,
        singleSelect:true,    //单行选择 
        striped:true,    //条纹显示
        rownumbers:true,    //是否显示行号
        toolbar:"#dgtoolbarCategory",  //工具栏
        columns:[
            [
                {field:'category_id',title:'id'},
                {field:'category_name',title:'栏目',editor:{type:'text'}},
                {field:'category_pid',title:'pid',editor:{type:'text'}},
            ],
        ],
        idField:"category_id",    //id 字段
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
    //生成控件操作及事件处理函数
///////////////////////////////////////////////////////////


    //生成datagrid
    $("#"+DG_CRUD_DOM_ID).datagrid(oDgCrud); 
    //生成dialog
    $("#"+DLG_CRUD_DOM_ID).dialog(oDlgCrud);


    //绑定单击事件:add
    $("#"+LBTN_ADDROW_DOM_ID).click(
        function(){
            showAddUpdateDialog(oDgCrud,DLG_CRUD_DOM_ID,URL_TO_ADD);
            //post
        }
    );



    //绑定单击事件:update
    $("#"+LBTN_UPDATEROW_DOM_ID).click(
        function(){
            //获取选择行
            var row=$("#"+DG_CRUD_DOM_ID).datagrid("getSelected");
            if(row!=null){
                showAddUpdateDialog(oDgCrud,DLG_CRUD_DOM_ID,URL_TO_UPDATE,row);
            }else{
                alert("必须先选择需要修改的行");
            }
            //post
        }
    );


    //绑定单击事件:remove
    $("#"+LBTN_REMOVEROW_DOM_ID).click(
        function(){
            //获取选择行
            var row=$("#"+DG_CRUD_DOM_ID).datagrid("getSelected");
            var idFieldName=getIDFieldFromDgJson(oDgCrud);
            if(idFieldName==null){
                alert("warning : 未指定idField字段，删除功能未触发");
                return ;
            }else{
                if(row!=null){
                    $.post(
                       URL_TO_REMOVE,
                       row,
                       function(){
                           //todo:校验返回success状态
                           alert("删除执行");
                       }
                    );
                }else{
                    alert("必须先选择需要修改的行");
                }
            }
        }
    );



    //CRUD操作的对话框中Save按钮 的事件处理函数
    function btnInCrudDiglogSave(){

        var url=$("#"+DLG_CRUD_DOM_ID+" form").attr("action"),
            postdata=$("#"+DLG_CRUD_DOM_ID+" form").serialize();
        $.post(
            url,
            postdata,
            function(){
                //todo:校验是否是success
                alert("数据保存成功");
            }
        );
        $("#"+DLG_CRUD_DOM_ID).dialog("close");
    }


    //CRUD操作的对话框中Cancel按钮 的事件处理函数
    function btnInCrudDiglogCancel(){

        $("#"+DLG_CRUD_DOM_ID).dialog("close");
    }










///////////////////////////////////////////////////////////
    //生成控件操作的中间函数
///////////////////////////////////////////////////////////


    //从用于构造datagrid的Json对象中获取字段数组
    function getFieldFromDgJson(oDgCrud){

        var columns=oDgCrud.columns,    //columns是表示多行表头的数组
            fieldarray=[];    //返回值,表示field的单行序列
        for(var i=0; i<columns.length;i++){
            for(var j=0 ;j< columns[i].length;j++){
                    var  item={};        //用于表示构成数组的字段项目,包含field和title
                    item.field=columns[i][j].field;    //字段
                    item.title=columns[i][j].title;    //title
                    item.editor=columns[i][j].editor;  //editor
                fieldarray.push(item);
            }
        }
        return fieldarray;
    }





    //从用于构造datagrid的Json对象中获取id字段名称 
    function getIDFieldFromDgJson(oDgCrud){

        return oDgCrud.idField;
    }





    //从fieldarray生成Form表单的输入内容(不含<form>和</form>标记)
    function genereateFormFromFieldArray(fieldarray){
        var html="",field="",title="";
        for(var i=0;i<fieldarray.length;i++){
            field=fieldarray[i].field;
            title=fieldarray[i].title;
            editor=fieldarray[i].editor;
            html+=(title+"<input name="+field +"><br>");
        }
        return html;
    }


    //设置对话框中的表单
    //当href==null,利用fieldarray生成表单
    //当href不为空，利用href远程加载表单
    function setFormInDlg(dlgDOMNODE,fieldarray,actionurl,href=null){
        if(href==null){
            if(dlgDOMNODE.length<=0){
                alert("Error in "+arguments.callee+"\r\n cannot find the dialog" );
            }else{
                var content="<form id='formAddUpdate'action='"
                    +actionurl+
                    "'method=post>";
                content+=genereateFormFromFieldArray(fieldarray);
                content+="</form>";
                dlgDOMNODE.html(content);
            }
        }else{
            dlgDOMNODE.dialog({href:"http://localhost"});
        }

        
    }



    //显示增加、删除操作的对话框
    //input:这里oDgCrud是JSON对象
    //input:dlgID是对话框的ID,之所以传递ID而非JSON对象, 是方便使用JQquery选择器
    //url:表单提交的地址
    //input:如果传递了row,则为Update操作，否则为Add操作
    function showAddUpdateDialog(oDgCrud,dlgID,url,row=null,href=null){

        var fieldarray=getFieldFromDgJson(oDgCrud),
            html=genereateFormFromFieldArray(fieldarray),
            dlgDOMNODE=$("#"+dlgID);

        if(dlgDOMNODE.length>0){
            setFormInDlg(dlgDOMNODE,fieldarray,url,href);

            if(row==null){    //Add操作
                $("#"+dlgID+" form").form("clear");
                dlgDOMNODE.dialog({title:"增加",iconCls:"icon-add"});
            }else{    //Update操作
                $("#"+dlgID+" form").form("load",row);
                dlgDOMNODE.dialog({title:"修改",iconCls:"icon-edit"});
            }

            dlgDOMNODE.dialog("refresh");
            dlgDOMNODE.dialog("open");
        }else{
            alert("error:cannot fine the dlgID:"
                +dlgID+"\r\n"
                +arguments.callee
            );
        }

    }




})();
</script>


</body>

</html>
