<!--datagrid-->
<table  id="dgCategory" title="栏目"> </table>





<!--工具栏-->
<div id="dgtoolbarCategory" >
    <a class=easyui-linkbutton id="lbtnCategoryAddRow" iconCls=icon-add >新增</a>
    <a class=easyui-linkbutton id="lbtnCategoryUpdateRow" iconCls=icon-edit>编辑</a>
    <a class=easyui-linkbutton id="lbtnCategoryRemoveRow" iconCls=icon-remove>删除</a>
</div>




<!--对话框之新增一行-->
<div class="easyui-dialog"
    closed=true resizbale=true width=560px
    id="dlgCRUD_Category" >
</div>





<script>
(function(){
    
    //用于构造datagrid 的JSON对象
    var oDg={
        url:"<?php echo $host_url ?>/index.php/category/datagrid_json" ,
        pagination:true,
        toolbar:"#dgtoolbarCategory",
        idField:"category_id",
        fit:true,
        singleSelect:true,
        striped:true,
        rownumbers:true,
        columns:[
            [
                {field:'category_id',title:'id'},
                {field:'category_name',title:'栏目',editor:{type:'text'}},
                {field:'category_pid',title:'pid',editor:{type:'text'}},
            ],
        ],
    }; 
    




    //生成datagrid
    $("#dgCategory").datagrid(oDg); 



    //绑定单击事件
    $("#lbtnCategoryAddRow").click(
        function(){

            var fieldarray=getFieldFromDgJson(oDg),
                html=genereateFormFromFieldArray(fieldarray),
                dlgDOMNODE=$("#dlgCRUD_Category");

            setFormInDlg(dlgDOMNODE,fieldarray,"http://www.baidu.com");
            $("#formCU").form("clear");
            dlgDOMNODE.dialog("open");
        }
    );



    //绑定单击事件
    $("#lbtnCategoryUpdateRow").click(
        function(){
            //获取选择行
            var row=$("#dgCategory").datagrid("getSelected");


            var fieldarray=getFieldFromDgJson(oDg),
                html=genereateFormFromFieldArray(fieldarray),
                dlgDOMNODE=$("#dlgCRUD_Category");

            setFormInDlg(dlgDOMNODE,fieldarray,"http://www.baidu.com");
            $("#formCU").form("load",row);
            dlgDOMNODE.dialog("open");


        }
    );


    //绑定单击事件
    $("#lbtnCategoryRemoveRow").click(
        function(){
        }
    );











/////////////////////////////////////////////////////////////////

    //从用于构造datagrid的Json对象中获取字段数组
    function getFieldFromDgJson(oDg){

        var columns=oDg.columns,    //columns是表示多行表头的数组
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
    function setFormInDlg(dlgDOMNODE,fieldarray,url,method='post'){
        if(dlgDOMNODE.length<=0){
            alert("Error in "+arguments.callee+"\r\n cannot find the dialog" );
        }else{
            var content="<form id='formCU' url='"+url+"' method="+method+">";
            content+=genereateFormFromFieldArray(fieldarray);
            dlgDOMNODE.html(content);
        }
        
    }





})();
</script>


</body>

</html>
