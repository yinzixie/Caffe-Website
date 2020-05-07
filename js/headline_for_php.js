/*js for headline, especially for all php pages*/

var state; //loging state

//validate the id input
function loginbox_validation() {
    if ($("#logid").val()=="") {
        alert("Please input your id.");
        return false;
    }
 
    return true;
}

//use ajax to show the output in the headline according to user's logging state
function returnstate(text) {
    return text;
}

function showloggingstate(returnstate) {
    var statehttp;
    statehttp = new XMLHttpRequest();
    statehttp.open("POST","./state.php",true);
    statehttp.send();
    
    statehttp.onreadystatechange=function() {
        if(statehttp.readyState==4 && statehttp.status==200) {
           
            state=statehttp.responseText;
            
            if(state=="login") {
              document.getElementById("logbutton").innerHTML="LOG OUT";
            }
        
            else {
                document.getElementById("logbutton").innerHTML="LOGIN";
            }
            returnstate(state);
           }
    }
}


$(document).ready(function(){
    
  showloggingstate(returnstate);//get loging state
     
     //beautify       
        $("#headline a").mouseover(function() {
            $(this).css("color","red")
            });
      
        $("#headline a").mouseout(function() {
            $(this).css("color","white")
            });    
        
     $("#login,#afterlogin input").mouseover(function() {
            $("#login input").css("background-color","red");
            $("#afterlogin input").css("background-color","red");
            });
            
         $("#login,#afterlogin input").mouseout(function() {
            $("#login input").css("background-color","deepskyblue");
            $("#afterlogin input").css("background-color","deepskyblue");
            });    
        
        $("#forget_password").mouseover(function(){
            $(this).css("color","red");
        });
    
        $("#forget_password").mouseout(function(){
            $(this).css("color","gray");
        });
    
        $("#dropdown a").mouseover(function() {
            $(this).css("color","deeppink");
            });   
            
       $("#dropdown a").mouseout(function() {
            $(this).css("color","white");
            });
    
    //show or hide cafe links dropdown area  
        $("#cafe").click(function(event) {
            $("#dropdown").slideToggle();  
            event.stopPropagation();
        });
     
    //show or hide loging area
        $("#logbutton").click(function(event) {
           
            if (state == "login")
            {
                $("#afterlogin").slideToggle();
            }
             else {
                 $("#loginBox").slideToggle();
                 }
            event.stopPropagation();
        }); 
        
        $("#loginBox,#afterlogin").click(function(event) {
            event.stopPropagation();
        }); 
            
        $(document).click(function(){
            $("#loginBox").hide();
            $("#dropdown").hide();
            $("#afterlogin").hide();
        }); 
            
    //only loging user can access account page
    $("#account").click(function(){
        if(state != "login") {
            $("#account").attr('href', '../register.html');
            alert("Please loging your account or register an account!");
        }
        else  {
            $("#account").attr('href', './account.php');
        }
    });    
        });
   