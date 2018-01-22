function setItem (index) {
	$("#account3").val($(".account"+index).html());
	$("#username3").val($(".username"+index).html());
	$("#phone3").val($(".phone"+index).html());
	$("#mail3").val($(".mail"+index).html());
	value=$(".sex"+index).html();
	console.log(value);
	if(value=="女")
	   sex=0;
	else sex=1;	
    $('input:radio[name="sex"][value='+sex+']').attr("checked",true);
}