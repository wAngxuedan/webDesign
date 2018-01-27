// 为修改用户的模态框赋值
function setItem (index) {
	$("#account3").val($(".account"+index).html());
	$("#username3").val($(".username"+index).html());
	$("#phone3").val($(".phone"+index).html());
	$("#mail3").val($(".mail"+index).html());
	value=$(".sex"+index).html();
	if(value=="女")
	   sex=0;
	else sex=1;	
    $('input:radio[name="sex"][value='+sex+']').attr("checked",true);
}

function deleteUser(id){
	  if(confirm("你确定要删除这一条记录吗")){
         window.location.href="/webDesign/admin.php/User/delete/id/"+id;
	  } 
}

function muldelete(){
    if(confirm("你确定要批量删除选中的记录吗")){
	    obj = document.getElementsByName("indexUser");
	    array = [];
	    for(k in obj){
	        if(obj[k].checked)
	            array.push(obj[k].value);
	    }
	     window.location.href="/webDesign/admin.php/User/muldelete/checked/"+JSON.stringify(array);
	}    
    
}
