/*eslint-env es6*/
function myFunction(){
	value = $('.quantityspan').html();
	$("#quantity").val(value);
	$("#my-form").submit();
}

function checkSubmission(){
	value = $('.quantityspan').html();
	if(value == 0){
		alert("Must select valid seats to reserve.");
		return false;
	}
	else{
		return true;
	}
}