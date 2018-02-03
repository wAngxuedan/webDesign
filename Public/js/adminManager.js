// 为修改管理员信息的模态框赋值
function setInfoItem (index) {
	$("#mid6").val($(".mid"+index).text());
	$("#range6").val($(".mrange"+index).text());
}
// 删除单个管理员记录
function deleteManager (id) {
	 if(confirm("你确定要删除这一条记录吗")){
         window.location.href="/webDesign/admin.php/Manager/delete/m_id/"+id;
	  } 
}
// 批量删除管理员
function muldeleteManager(){
    if(confirm("你确定要批量删除选中的记录吗")){
	    obj = document.getElementsByName("indexManager");
	    array = [];
	    for(k in obj){
	        if(obj[k].checked)
	            array.push(obj[k].value);
	    }
	     window.location.href="/webDesign/admin.php/Manager/muldelete/checked/"+JSON.stringify(array);
	}      
}