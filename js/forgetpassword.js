//validation for eamil
function validation_email() {
    if( /[\s]/.test($("#user_email").val()) ) {
            alert("Wrong format of email!");
            return false;
       } 
    else  {
        return true;
        }
}

//validation for verification code
function validation_code() {

  if(/[^0-9]/.test($("#user_code").val()) ) {
                alert("Wrong format of code!");
                return false;
            }
    else {
        return true;
    }
}    
    
//validation for password
function validation_password() {
     if ($("#user_password").val().length<6 || $("#user_password").val().length>12 || !/([0-9])/.test($("#user_password").val()) || !/([a-z])/.test($("#user_password").val()) || !/([A-Z])/.test($("#user_password").val())|| !/([\!\#\$\~])/.test($("#user_password").val())  ) {
                alert("your password should contain at least 1 lower case letter, 1 uppercase letter, 1 number and one of the following special characters ~ ! # $ .");
                return false;
            } 

           else if ($("#user_password").val() != $("#user_confirm_password").val()) {
                alert("Password does not match!");
                return false;
            }
    
            else {
                return true;
            }
}
//validation for adding staff operation
function validation_id() {

    if($("#user_id").val()=="" || !/^[A-Z]{2}[0-9]{4}$/.test($("#user_id").val()) ) {
                alert("Wrong format of ID!");
                return false;
            }
    else {
        return true;
    }
}

$(document).ready(function(){
    
    $("#container").on("input",".step",function() {
    //hint for input password and id
            if($("#user_id").val()=="" || !/^[A-Z]{2}[0-9]{4}$/.test($("#user_id").val()) ) {
                $("#user_id").parent().find(".hint_wrong, .hint_right").remove();
                $("#user_id").after("<span  class='hint_wrong'>✘</span>");
            }
            else {
                $("#user_id").parent().find(".hint_wrong, .hint_right").remove();
                $("#user_id").after("<span  class='hint_right'>✔</span>");
            }
           if ($("#user_password").val().length<6 || $("#user_password").val().length>12 || !/([0-9])/.test($("#user_password").val()) || !/([a-z])/.test($("#user_password").val()) || !/([A-Z])/.test($("#user_password").val())|| !/([\!\#\$\~])/.test($("#user_password").val())  ) {
                
                $("#user_password,#user_confirm_password").parent().find(".hint_wrong, .hint_right").remove();
                $("#user_password,#user_confirm_password").after("<span  class='hint_wrong'>✘ <h1>6﹤nCc(!#$~)﹤12</h1>");
            } 
            else  {
                $("#user_password,#user_confirm_password").parent().find(".hint_wrong, .hint_right").remove();
                $("#user_password,#user_confirm_password").after("<span  class='hint_right'>✔</span>");
            } 
            
            if ($("#user_password").val() != $("#user_confirm_password").val()) {
                $("#user_confirm_password").parent().find(".hint_wrong, .hint_right").remove();
                $("#user_confirm_password").after("<span  class='hint_wrong'>✘");
            }
            else {
                $("#user_confirm_password").parent().find(".hint_wrong, .hint_right").remove();
                $("#user_confirm_password").after("<span  class='hint_right'>✔</span>");
            }
    
    });   
});