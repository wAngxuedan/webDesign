// 为修改用户的模态框赋值
function setUserItem (index) {
	$("#account3").val($(".account"+index).text());
	$("#username3").val($(".username"+index).text());
	$("#phone3").val($(".phone"+index).text());
	$("#mail3").val($(".mail"+index).text());
	value=$(".sex"+index).text();
	if(value=="女")
	   sex=0;
	else sex=1;	
    $('input:radio[name="sex"][value='+sex+']').attr("checked",true);
}
// 删除单个用户
function deleteUser(id){
	  if(confirm("你确定要删除这一条记录吗")){
         window.location.href="/webDesign/admin.php/User/delete/id/"+id;
	  } 
}
// 批量删除用户
function muldeleteUser(){
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
// 为修改咨讯的模态框赋值
function setInfoItem (index) {
	$("#title5").val($(".title"+index).text());
	$("#content5").val($(".content"+index).text());
	$("#time5").val($(".time"+index).text());
	$("#from5").val($(".from"+index).text());
	$("#id5").val($(".id"+index).text());
}
// 删除单条咨讯
function deleteInfo (id) {
	 if(confirm("你确定要删除这一条记录吗")){
         window.location.href="/webDesign/admin.php/Info/delete/id/"+id;
	  } 
}
// 批量删除咨讯
function muldeleteInfo(){
    if(confirm("你确定要批量删除选中的记录吗")){
	    obj = document.getElementsByName("indexInfo");
	    array = [];
	    for(k in obj){
	        if(obj[k].checked)
	            array.push(obj[k].value);
	    }
	     window.location.href="/webDesign/admin.php/Info/muldelete/checked/"+JSON.stringify(array);
	}    
    
}
