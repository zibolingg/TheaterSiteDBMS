/*eslint-env es6*/
function creditCardValidation(creditCardNum)
{
var string = creditCardNum.value;
var stripped_string = string.replace(/[-\s]/g,"");
var regEx = /^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/;
   if(stripped_string.match(regEx)){
	  return true;
   }
   else{
	 alert("Please enter a valid credit card number [13-18 digits ex. 1234123412341234]");
	 return false;
   }
}    
