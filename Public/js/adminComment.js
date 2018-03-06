// 删除单个评论
function deleteComment(id){
	  if(confirm("你确定要删除这一条记录吗")){
         window.location.href="/webDesign/admin.php/Comment/delete/id/"+id;
	  } 
}
// 批量删除评论
function muldeleteComment(){
    if(confirm("你确定要批量删除选中的记录吗")){
	    obj = document.getElementsByName("indexComment");
	    array = [];
	    for(k in obj){
	        if(obj[k].checked)
	            array.push(obj[k].value);
	    }
	     window.location.href="/webDesign/admin.php/Comment/muldelete/checked/"+JSON.stringify(array);
	}      
}