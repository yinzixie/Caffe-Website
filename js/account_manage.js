//js for account management page

//validation for eamil
function validation_email() {
    if( !/^[A-Za-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;]+[A-Za-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;\.]*[A-Za-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;]@([A-Za-z0-9/-]+[.])+[A-Za-z0-9/-]{1,}$/.test($("#email").val()) || /([\S]{65,})@([\S])/.test($("#email").val()) || /([\S])@([\S]{256,})/.test($("#email").val()) || /([\.])\1/.test($("#email").val().match(/(\S*)@/)[1]) ) {
            alert("Wrong format of email!");
            return false;
       } 
    else  {
        return true;
        }
}

//validation for mobile number
function validation_mobile_phone() {
    if($("#phonenumber").val()=="" || /([^0-9])/.test($("#phonenumber").val())) {
                alert("Wrong format of phone number!");
                return false;
            } 
            else  {
                return true;
            }
}

//validation for password
function validation_password() {
     if ($("#password").val().length<6 || $("#password").val().length>12 || !/([0-9])/.test($("#password").val()) || !/([a-z])/.test($("#password").val()) || !/([A-Z])/.test($("#password").val())|| !/([\!\#\$\~])/.test($("#password").val())  ) {
                alert("your password should contain at least 1 lower case letter, 1 uppercase letter, 1 number and one of the following special characters ~ ! # $ .");
                return false;
            } 

           else if ($("#password").val() != $("#confirm_password").val()) {
                alert("Password does not match!");
                return false;
            }
    
            else {
                return true;
            }
}

//validation for adding staff operation
function validation_add_staff() {
    if ($("#name").val()=="" || !/[A-Za-z/s]$/.test($("#name").val())){
                alert("Wrong format of name!");
                return false;
            } 
           
    else if($("#add_staff_IDnumber").val()=="" || !/^CM[0-9]{4}$/.test($("#add_staff_IDnumber").val()) ) {
                alert("Wrong format of ID!");
                return false;
            } 
            
    else if( !/^[A-Za-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;]+[A-Za-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;\.]*[A-Za-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;]@([A-Za-z0-9/-]+[.])+[A-Za-z0-9/-]{1,}$/.test($("#add_staff_email").val()) || /([\S]{65,})@([\S])/.test($("#add_staff_email").val()) || /([\S])@([\S]{256,})/.test($("#add_staff_email").val()) || /([\.])\1/.test($("#add_staff_email").val().match(/(\S*)@/)[1]) ) {
                alert("Wrong format of email!");
                return false;
           } 
            
    else if($("#add_staff_phonenumber").val()=="" || /([^0-9])/.test($("#add_staff_phonenumber").val())) {
                alert("Wrong format of phone number!");
                return false;
            } 
           
    else if($("#creditcard").val()=="" || /([^0-9])/.test($("#creditcard").val())) {
                alert("Wrong format of Credut Card Number!");
                return false;
            } 
          
    else if ($("#add_staff_password").val() == "") {
                alert("Wrong format of password!");
                return false;
            }
           
    else if ($("#add_staff_password").val() != $("#add_staff_confirm_password").val() ) {
                alert("Password does not match!");
                return false;
            }
    
    else {
               return true;
           }
}

//validation for removing staff operation
function validation_remove_staff() {
    if($("#remove_staff_id").val()=="" || !/^CM[0-9]{4}$/.test($("#remove_staff_id").val()) ) {
                alert("Wromg format of ID!");
                return false;
            } 
    else  {
              return true; 
            }
}

//validation for allocating manager operation
function validation_allocate_manager() {
    if ($("#allocate_staff_to_manager_id").val()=="" || !/^CM[0-9]{4}$/.test($("#allocate_staff_to_manager_id").val()) ) {
                alert("Wromg format of ID!");
                return false;
            }
    else if ($("#allocate_staff_to_manager_new_id").val()=="" || !/^CA[0-9]{4}$/.test($("#allocate_staff_to_manager_new_id").val()) ) {
                alert("Wromg format of ID!");
                return false;
            }    
    else  {
              return true; 
            }
}


//validation for allocating cafe operation
function validation_allocate_cafe() {
    if($("#allocate_cafe_id").val()=="" || !/^CM[0-9]{4}$/.test($("#allocate_cafe_id").val()) ) {
                alert("Wromg format of ID!");
                return false;
            } 
    else  {
              return true; 
            }
}

//confirm operation 
function confirm_operation() {
    return confirm("Confirm your operation!");
}

$(document).ready(function(){
    //default setting according to previous operation
    $.get("./show_manage_account_operation_area.php",
                   function(data){

                        var idname = data;
                        var text = "Last Operation";
                        $(".change[id!="+idname+"]").hide();
                        $(".change[id ="+idname+"]").show();

                        if (!$(".navigator").is("#"+idname)) {
                            $("#stop_event").append("<div class='navigator' id="+idname+"><div class='navigator_decoration_line'></div><a href='javarscript:void(0)'>"+text+"</a><input type='button' class='close_form' value='×'/></div>");
                        }

                        $("#normal_operation li, #board_member_operation li").css("background-color","#052963");
                        $(this).parent().css("background-color","deepskyblue");

                        $(".navigator[id !="+idname+"]").css("background-color","white")
                        $(".navigator[id ="+idname+"]").css("background-color","aliceblue")
                        $(".navigator[id !="+idname+"] .navigator_decoration_line").css("background-color","white")
                        $(".navigator[id ="+idname+"] .navigator_decoration_line").css("background-color","red")
                    })
    
    
    
    //RESET BUTTON FUNCITON 
    $(".reset_button").click(function() {
        $(this).parent().parent().find("input[type='text'], input[type='password']").each(function(){$(this).val("");});   
    });

//show hint when user input thier information
        $(".change").on("input",function() {
            
            //add staff area 
            if ($("#name").val()=="" || !/[A-Za-z/s]$/.test($("#name").val())){
                $("#name").parent().find(".hint_wrong, .hint_right").remove();
                $("#name").after("<span  class='hint_wrong'>✘");
            } 
            else  {
                $("#name").parent().find(".hint_wrong, .hint_right").remove();
                $("#name").after("<span  class='hint_right'>✔</span>");
            }
            
            if($("#add_staff_IDnumber").val()=="" || !/^CM[0-9]{4}$/.test($("#add_staff_IDnumber").val()) ) {
                $("#add_staff_IDnumber").parent().find(".hint_wrong, .hint_right").remove();
                $("#add_staff_IDnumber").after("<span  class='hint_wrong'>✘ CMnnnn");
            } 
            else  {
                $("#add_staff_IDnumber").parent().find(".hint_wrong, .hint_right").remove();
                $("#add_staff_IDnumber").after("<span  class='hint_right'>✔</span>");
            }   
            
            if( !/^[A-Za-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;]+[A-Za-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;\.]*[A-Za-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;]@([A-Za-z0-9/-]+[.])+[A-Za-z0-9/-]{1,}$/.test($("#add_staff_email").val()) || /([\S]{65,})@([\S])/.test($("#add_staff_email").val()) || /([\S])@([\S]{256,})/.test($("#add_staff_email").val()) || /([\.])\1/.test($("#add_staff_email").val().match(/(\S*)@/)[1]) ) {
               $("#add_staff_email").parent().find(".hint_wrong, .hint_right").remove();
               $("#add_staff_email").after("<span  class='hint_wrong'>✘ you@example.com</span>");
           } 
            else  {
                $("#add_staff_email").parent().find(".hint_wrong, .hint_right").remove();
                $("#add_staff_email").after("<span  class='hint_right'>✔</span>");
            }
            
            if($("#add_staff_phonenumber").val()=="" || /([^0-9])/.test($("#add_staff_phonenumber").val())) {
                $("#add_staff_phonenumber").parent().find(".hint_wrong, .hint_right").remove();
                $("#add_staff_phonenumber").after("<span  class='hint_wrong'>✘");
            } 
            else  {
                $("#add_staff_phonenumber").parent().find(".hint_wrong, .hint_right").remove();
                $("#add_staff_phonenumber").after("<span  class='hint_right'>✔</span>");
            }
            
            if($("#creditcard").val()=="" || /([^0-9])/.test($("#creditcard").val())) {
                $("#creditcard").parent().find(".hint_wrong, .hint_right").remove();
                $("#creditcard").after("<span  class='hint_wrong'>✘");
            } 
            else  {
                $("#creditcard").parent().find(".hint_wrong, .hint_right").remove();
                $("#creditcard").after("<span  class='hint_right'>✔</span>");
            } 
            
            if ($("#add_staff_password").val() == "") {
                $("#add_staff_password").parent().find(".hint_wrong, .hint_right").remove();
                $("#add_staff_password").after("<span  class='hint_wrong'>✘ 6﹤nCc(!#$~)﹤12");
            }
            else {
                $("#add_staff_password").parent().find(".hint_wrong, .hint_right").remove();
                $("#add_staff_password").after("<span  class='hint_right'>✔</span>");
            }
            
            if ($("#add_staff_password").val() != $("#add_staff_confirm_password").val() ) {
                $("#add_staff_confirm_password").parent().find(".hint_wrong, .hint_right").remove();
                $("#add_staff_confirm_password").after("<span  class='hint_wrong'>✘");
            }
            else {
                $("#add_staff_confirm_password").parent().find(".hint_wrong, .hint_right").remove();
                $("#add_staff_confirm_password").after("<span  class='hint_right'>✔</span>");
            }
            
            //area of remove staff
            if($("#remove_staff_id").val()=="" || !/^CM[0-9]{4}$/.test($("#remove_staff_id").val()) ) {
                $("#remove_staff_id").parent().find(".hint_wrong, .hint_right").remove();
                $("#remove_staff_id").after("<span  class='hint_wrong'>✘ CMnnnn");
            } 
            else  {
                $("#remove_staff_id").parent().find(".hint_wrong, .hint_right").remove();
                $("#remove_staff_id").after("<span  class='hint_right'>✔</span>");
            }
            
            //area of allocate manager 
            if($("#allocate_staff_to_manager_id").val()=="" || !/^CM[0-9]{4}$/.test($("#allocate_staff_to_manager_id").val()) ) {
                $("#allocate_staff_to_manager_id").parent().find(".hint_wrong, .hint_right").remove();
                $("#allocate_staff_to_manager_id").after("<span  class='hint_wrong'>✘ CMnnnn");
            } 
            else  {
                $("#allocate_staff_to_manager_id").parent().find(".hint_wrong, .hint_right").remove();
                $("#allocate_staff_to_manager_id").after("<span  class='hint_right'>✔</span>");
            }
            
            if($("#allocate_staff_to_manager_new_id").val()=="" || !/^CA[0-9]{4}$/.test($("#allocate_staff_to_manager_new_id").val()) ) {
                $("#allocate_staff_to_manager_new_id").parent().find(".hint_wrong, .hint_right").remove();
                $("#allocate_staff_to_manager_new_id").after("<span  class='hint_wrong'>✘ CAnnnn");
            } 
            else  {
                $("#allocate_staff_to_manager_new_id").parent().find(".hint_wrong, .hint_right").remove();
                $("#allocate_staff_to_manager_new_id").after("<span  class='hint_right'>✔</span>");
            }
            
            //area of allocate cafe
            if($("#allocate_cafe_id").val()=="" || !/^CM[0-9]{4}$/.test($("#allocate_cafe_id").val()) ) {
                $("#allocate_cafe_id").parent().find(".hint_wrong, .hint_right").remove();
                $("#allocate_cafe_id").after("<span  class='hint_wrong'>✘ CMnnnn");
            } 
            else  {
                $("#allocate_cafe_id").parent().find(".hint_wrong, .hint_right").remove();
                $("#allocate_cafe_id").after("<span  class='hint_right'>✔</span>");
            }
            
            //normal user's area
            if( !/^[A-Za-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;]+[A-Za-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;\.]*[A-Za-z0-9\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;]@([A-Za-z0-9/-]+[.])+[A-Za-z0-9/-]{1,}$/.test($("#email").val()) || /([\S]{65,})@([\S])/.test($("#email").val()) || /([\S])@([\S]{256,})/.test($("#email").val()) || /([\.])\1/.test($("#email").val().match(/(\S*)@/)[1]) ) {
               $("#email").parent().find(".hint_wrong, .hint_right").remove();
               $("#email").after("<span  class='hint_wrong'>✘ you@example.com</span>");
           } 
            else  {
                $("#email").parent().find(".hint_wrong, .hint_right").remove();
                $("#email").after("<span  class='hint_right'>✔</span>");
            }
            
            if($("#phonenumber").val()=="" || /([^0-9])/.test($("#phonenumber").val())) {
                $("#phonenumber").parent().find(".hint_wrong, .hint_right").remove();
                $("#phonenumber").after("<span  class='hint_wrong'>✘");
            } 
            else  {
                $("#phonenumber").parent().find(".hint_wrong, .hint_right").remove();
                $("#phonenumber").after("<span  class='hint_right'>✔</span>");
            }
            
            if ($("#password").val().length<6 || $("#password").val().length>12 || !/([0-9])/.test($("#password").val()) || !/([a-z])/.test($("#password").val()) || !/([A-Z])/.test($("#password").val())|| !/([\!\#\$\~])/.test($("#password").val())  ) {
                
                $("#password,#confirm_password").parent().find(".hint_wrong, .hint_right").remove();
                $("#password,#confirm_password").after("<span  class='hint_wrong'>✘ 6﹤nCc(!#$~)﹤12");
            } 
            else  {
                $("#password,#confirm_password").parent().find(".hint_wrong, .hint_right").remove();
                $("#password,#confirm_password").after("<span  class='hint_right'>✔</span>");
            } 
            
            if ($("#password").val() != $("#confirm_password").val()) {
                $("#confirm_password").parent().find(".hint_wrong, .hint_right").remove();
                $("#confirm_password").after("<span  class='hint_wrong'>✘ 6﹤nCc(!#$~)﹤12");
            }
            else {
                $("#confirm_password").parent().find(".hint_wrong, .hint_right").remove();
                $("#confirm_password").after("<span  class='hint_right'>✔</span>");
            }
            
        });
    
//beautify    
    $(".change").hide();

    $("#navigation").on("mouseover",".close_form",function(){
        $(this).css("background-color","red");
    });
    
    $("#navigation").on("mouseout",".close_form",function(){
        $(this).css("background-color","transparent");
    });

    //show navigator according to user's choice
    $("#normal_operation a, #board_member_operation a").click(function() {
        var idname=$(this).attr("class");
        var text;
        
        if($(this).attr("class") == "change_email") {
            text="Change Email";
            
            //store currently state
            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"change_email"
                    })
        }
        else if($(this).attr("class") == "change_mobile") {
            text="Change Mobile"; 
            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"change_mobile"
                    })
        }
        else if($(this).attr("class") == "change_password") {
            text="Change Password";       
            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"change_password"
                    })
        }
        else if($(this).attr("class") == "add_cafe_staff") {
            text="Add Cafe Staff";       
            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"add_cafe_staff"
                    })
        }
        else if($(this).attr("class") == "remove_cafe_staff") {
            text="Remove Cafe Staff";  
            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"remove_cafe_staff"
                    })
        }
        else if($(this).attr("class") == "allocate_staff_to_managers") {
            text="Allocate Managers"; 
            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"allocate_staff_to_managers"
                    })
        }
        else if($(this).attr("class") == "allocate_staff_to_cafe") {
            text="Allocate Cafe Staff";     
            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"allocate_staff_to_cafe"
                    })
        }
        
        $(".change[id!="+idname+"]").hide();
        $(".change[id ="+idname+"]").show();
        
        if (!$(".navigator").is("#"+idname)) {
            $("#stop_event").append("<div class='navigator' id="+idname+"><div class='navigator_decoration_line'></div><a href='javarscript:void(0)'>"+text+"</a><input type='button' class='close_form' value='×'/></div>");
        }
        
        $("#normal_operation li, #board_member_operation li").css("background-color","#052963");
        $(this).parent().css("background-color","deepskyblue");
        
        $(".navigator[id !="+idname+"]").css("background-color","white")
        $(".navigator[id ="+idname+"]").css("background-color","aliceblue")
        $(".navigator[id !="+idname+"] .navigator_decoration_line").css("background-color","white")
        $(".navigator[id ="+idname+"] .navigator_decoration_line").css("background-color","red")
            
    });
    
    $("#navigation").on("click",".navigator",function() {
        var idname = $(this).attr("id")
        
         //store currently state
        if(idname == "change_email") {

            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"change_email"
                    })
        }
        else if(idname == "change_mobile") {
           
            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"change_mobile"
                    })
        }
        else if(idname == "change_password") {
            
            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"change_password"
                    })
        }
        else if(idname == "add_cafe_staff") {
               
            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"add_cafe_staff"
                    })
        }
        else if(idname == "remove_cafe_staff") {
           
            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"remove_cafe_staff"
                    })
        }
        else if(idname == "allocate_staff_to_managers") {
            
            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"allocate_staff_to_managers"
                    })
        }
        else if(idname == "allocate_staff_to_cafe") {
           
            $.get("./show_manage_account_operation_area.php",
                   {
                        operation_state:"allocate_staff_to_cafe"
                    })
        }
        
        $(".change[id!="+idname+"]").hide();
        $(".change[id ="+idname+"]").show();
        
        $("#normal_operation li, #board_member_operation li").css("background-color","#052963");
        $("."+idname).parent().css("background-color","deepskyblue");
        
        $(".navigator[id !="+idname+"]").css("background-color","white")
        $(this).css("background-color","aliceblue")
        $(".navigator[id !="+idname+"] .navigator_decoration_line").css("background-color","white")
        $(this).find(".navigator_decoration_line").css("background-color","red")
    });
   
    $("#stop_event").on("click",".close_form",function() {
        var idname=$(this).parent().attr("id");
        
        $(this).parent().remove();

        $(".change[id ="+idname+"]").hide();
        event.stopPropagation();
    });
    
});