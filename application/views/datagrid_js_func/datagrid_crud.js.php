
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
            showAddMODIFYDialog(oDgCrud,DLG_CRUD_DOM_ID,URL_TO_ADD);
        }
    );



    //绑定单击事件:modify
    $("#"+LBTN_MODIFYROW_DOM_ID).click(
        function(){
            //获取选择行
            var row=$("#"+DG_CRUD_DOM_ID).datagrid("getSelected");
            if(row!=null){
                showAddMODIFYDialog(oDgCrud,DLG_CRUD_DOM_ID,URL_TO_MODIFY,row);
            }else{
                alert("必须先选择需要修改的行");
            }
            //post
        }
    );


    //绑定单击事件:remove
    $("#"+LBTN_REMOVEROW_DOM_ID).click(
        function(){
            var row=$("#"+DG_CRUD_DOM_ID).datagrid("getSelected");
            var idFieldName=getIDFieldFromDgJson(oDgCrud);

            if(idFieldName==null){
                alert("warning : 配置中未指定idField字段，删除功能未触发");
                return ;
            }else{
                if(row!=null){
                    $.messager.confirm("警告",
                        "当前正在执行删除:\r\n"+
                            "行ID"+row[idFieldName]+
                            "\r\n 该操作不可恢复，请请确认是否继续?",
                        function(isOK){
                            if(isOK){
                                removeRow(row,idFieldName,URL_TO_REMOVE);
                            }
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
            function(data){
                if(data=="success"){
                    $.messager.show({
                        title:"保存成功",
                        msg:"记录已经保存成功:",
                    });
                    //刷新表格
                    $("#"+DG_CRUD_DOM_ID).datagrid("reload");
                }else{
                    alert("当前操作未成功，请稍候再试");
                }
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
                var content="<form id='formAddMODIFY'action='"
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
    //input:如果传递了row则为modify操作，否则为Add操作
    function showAddMODIFYDialog(oDgCrud,dlgID,url,row=null,href=null){

        var fieldarray=getFieldFromDgJson(oDgCrud),
            html=genereateFormFromFieldArray(fieldarray),
            dlgDOMNODE=$("#"+dlgID);

        if(dlgDOMNODE.length>0){
            setFormInDlg(dlgDOMNODE,fieldarray,url,href);

            if(row==null){    //Add操作
                $("#"+dlgID+" form").form("clear");
                dlgDOMNODE.dialog({title:"增加",iconCls:"icon-add"});
            }else{    //modify操作
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




    //删除行
    //row:行数据对象，json，格式类似于{field:value,field2:value2,...}
    //idFieldName:ID字段名称，用于最后提示的消息对话框
    //URL_TO_REMOVE:服务端处理remove操作的url
    function removeRow(row,idFieldName,URL_TO_REMOVE){

        if(row!=null){
            $.post(
                URL_TO_REMOVE,
                row,
                function(data){
                    //todo:校验返回success状态
                    if(data=="success"){
                        $.messager.show({
                            title:"删除成功",
                            msg:"记录:"+row[idFieldName]+" 已经被删除!",
                        });
                        //刷新表格
                        $("#"+DG_CRUD_DOM_ID).datagrid("reload");
                    }else{
                        alert("当前删除操作未成功，请稍候再试");
                    }
                }
            );
        }
    }

