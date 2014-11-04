<!--datagrid-->
<table  id="dgCategory" title="栏目"> </table>





<!--工具栏-->
<div id="dgtoolbarCategory" >
    <a class=easyui-linkbutton id="lbtnAdd_CategoryRow" iconCls=icon-add >新增</a>
    <a class=easyui-linkbutton iconCls=icon-edit>编辑</a>
    <a class=easyui-linkbutton iconCls=icon-remove>删除</a>
</div>




<!--对话框之新增一行-->
<div class="easyui-dialog" closed=true buttons="#dlgAdd-CategoryRow" title="增加">

    <div >
    test form
    </div>

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
        singleselect:true,
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



    $("#lbtnAdd_CategoryRow").click(
        function(){
            fieldarray=getFieldFromDgJson(oDg);
            html=genereateFormFromFieldArray(fieldarray);
            alert(html);
        }
    );





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
    function genereateFormFromFieldArray(){
        var html="",field="",title="";
        for(var i=0;i<fieldarray.length;i++){
            field=fieldarray[i].field;
            title=fieldarray[i].title;
            editor=fieldarray[i].editor;
            html+=(title+"<input name="+field +"><br>");
        }
        return html;
    }





})();
</script>


</body>

</html>
