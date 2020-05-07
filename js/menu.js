//js for menu pages
var discount=0; //discount
var balance=0; //balance
var cafe_name;
//calculate cost when iteam is added to the trolley
function calculate_and_show_cost(balance,discount,cafe_name) {
    var cost=0.00;
        if ($(".cart_iteam").length===0) {
            $("#cost_digital").empty();
            $("#cost_digital").append(" 0.00");
            
            $("#real_cost").attr("value","0");
            //remove order
                     $.post("./temp_cart.php",
                   {
                       kind:"clean", cafe:cafe_name
                    });
        }
        
        else { 
            $(".cart_iteam").each(function(){
            cost=(parseFloat($(this).find(".cart_iteam_price").text().replace(/[^0-9.]/ig,""))*parseFloat($(this).find(".cart_iteam_amount").val())+parseFloat(cost)).toFixed(2);
           
            if(cost=="NaN") {
                cost=0.00;
            }
            $("#cost_digital").empty();
            $("#cost_digital").append(" "+cost);
                
            $(this).find(".form_iteam_amount").attr("value",$(this).find(".cart_iteam_amount").val());
                
                var id=$(this).attr("id");
                var amount=$(this).find(".cart_iteam_amount").val();
                var description=$(this).find(".input_iteam_require").val();
                
                     $.post("./temp_cart.php",
                   {
                       p_id:id , p_amount:amount , p_description:description ,kind:"input", cafe:cafe_name
                    });
                
            });
        }
    
    //set or remove scroll
        if ($(".cart_iteam").length===4) {
            $(".trolley_iteam fieldset").css({"height":"10cm","overflow-y":"auto"});
        }
        if ($(".cart_iteam").length<4) {
            $(".trolley_iteam fieldset").css("height","");
        }
    
        document.getElementById("after_discount").innerHTML=(cost-cost*discount*0.01).toFixed(2);
        document.getElementById("show_expect_balance").innerHTML=(balance-(cost-cost*discount*0.01)).toFixed(2);
    
        $("#real_cost").attr("value",(cost-cost*discount*0.01).toFixed(2));
}

//order submit validation
function order_validation() {
    //MAKE SURE EVERY THING IS UPDATE.
            calculate_and_show_cost(balance,discount,cafe_name);
            if (state != "login") {
                alert("To submit the order,you have to login first!");
                return false;
            }
            else if(parseFloat($("#show_expect_balance").text())<0) {
               alert("No enough money!");
                return false;
            }
            else if($(".cart_iteam").length===0) {
                alert("Your cart is empty!");
                return false;
            }        
            else  {
                 if(window.confirm("Confirm your choice? Final Cost: $"+$("#after_discount").text())) {
                    return true;
                  }
                else {
                return false;
                }
            }
}

$(document).ready(function(){
//initialise the cost of cart    
    calculate_and_show_cost(balance,discount,cafe_name);
    
//defalut set (show the menu of masterfood)
        $("#option_masterfood").css("background-color","white");
        $("#option_masterfood a").css("color","black");
        $(".masterfood").show();

                   
     
       //master food area
        $("#option_masterfood").click(function() {
            $(this).css("background-color","white");
            $("#option_masterfood a").css("color","black");
            $("#option_beverage a").css("color","white");
            $("#option_beverage").css("background-color","deepskyblue");
             $(".beverage").hide();
            
            if ($(".masterfood").css("display")=="none") { // show master food area
                $(".masterfood").fadeToggle("slow");
            }
        });
    
    //beverage area
        $("#option_beverage").click(function() {
            $(this).css("background-color","white");
            $("#option_beverage a").css("color","black");
            $("#option_masterfood a").css("color","white");
            $("#option_masterfood").css("background-color","deepskyblue");  
            $(".masterfood").hide();
            
            if ( $(".beverage").css("display")=="none") { // show beverage area
                $(".beverage").fadeToggle("slow");
            }
        });
    
    //clean cart,remove all products
        $("#clean_cart").click(function(){
           $(".trolley_iteam fieldset").empty();
            
            //remove order
                     $.post("./temp_cart.php",
                   {
                       kind:"clean", cafe:cafe_name
                    });
        });
    
    //add and remove iteam in cart, and upload the temporary data to database
        $(".container").on("click",".product_add_button",function(){
            var iteam=$(this).parent().parent().parent().parent().find(".product-title").text();
            var price=$(this).parent().parent().parent().parent().find(".product_price").text();
            
            if (!$(".cart_iteam").is("[id='"+iteam+"']")) {
                //for loging user
                if (state=="login") {
                $(".trolley_iteam fieldset").append("<div class='cart_iteam' id='"+iteam+"'><p>"+iteam+"</p><div class='cart_iteam_price'>"+price+"<span> ×</span></div>"+"<input type='hidden' name='iteam_name[]' value='"+iteam+"'><input type='hidden' name='iteam_price[]' value="+price+"><input type='number' value=1 min='1' max='999' name='cart_iteam_amount' class='cart_iteam_amount'>"+"<div class='cart_iteam_require'><input type='text' name='iteam_require' class='input_iteam_require' placeholder='Extra  Specifics'/></div><div class='cart_iteam_remove'><a href='javascript:void(0)' class='cart_iteam_remove_button'>×</a></div>"+"<HR class='trolley_line'/></div>");
                
                    //generate a temp cart, and update data
                    $.post("./temp_cart.php",
                   {
                        p_id:iteam, p_amount:"1", p_description:"", kind:"add", cafe:cafe_name
                    });
                    
                }
                //for visitor
                else {
                $(".trolley_iteam fieldset").append("<div class='cart_iteam' id='"+iteam+"'><p>"+iteam+"</p><div class='cart_iteam_price'>"+price+"<span> ×</span></div>"+"<input type='hidden' name='iteam_name[]' value='"+iteam+"'><input type='hidden' name='iteam_price[]' value="+price+"><input type='hidden' value=1  name='cart_iteam_amount' class='cart_iteam_amount'/><input type='number'placeholder='Locked, please log in' readonly>"+"<div class='cart_iteam_require'></div><div class='cart_iteam_remove'><a href='javascript:void(0)' class='cart_iteam_remove_button'>×</a></div>"+"<HR class='trolley_line'/></div>");    
                }
            }
            
            else {
               // for loging user
                if(state=="login"){
                var amount=parseFloat($("[id='"+iteam+"'] .cart_iteam_amount").val())+1;
                $("[id='"+iteam+"'] .cart_iteam_amount").attr("value",amount);
                $("[id='"+iteam+"'] .cart_iteam_amount").val(amount);

                }
            }
    
            //annimation for add button and text of quantiy
            if(!$("[id='"+iteam+"'] .cart_iteam_amount").is(':animated')) {
               $("[id='"+iteam+"'] .cart_iteam_amount").animate({"font-size":"40px"});
                $("[id='"+iteam+"'] .cart_iteam_amount").animate({"font-size":"17px"},"slow");
               } 
         
        });
    
    //remove product from both cart and database
        $(".trolley_iteam").on("click",".cart_iteam_remove_button",function() {
            var id=$(this).parent().parent().attr("id");
            //remove order
                     $.post("./temp_cart.php",
                   {
                      p_id:id, kind:"remove", cafe:cafe_name
                    });
            
            $(this).parent().parent().remove();

        });
    
    //caculate and output the cost, and update order's details
    $(document).on("click",function() {
        calculate_and_show_cost(balance,discount,cafe_name);
        
    });
    
     $('.container').on('input',".cart_iteam_amount",function(){  
         calculate_and_show_cost(balance,discount,cafe_name);

    });
    
    //beautify
    //remove button
    $(".trolley_iteam").on("mouseover",".cart_iteam_remove",function() { 
        $(this).css("background-color","red");   
         $(this).find(".cart_iteam_remove_button").css("color","white");   
    });
    
    $(".trolley_iteam").on("mouseout",".cart_iteam_remove",function() { 
        $(this).css("background-color","transparent");   
         $(this).find(".cart_iteam_remove_button").css("color","red");   
    });

    //submit button
        $("#trolley_submit").mouseover(function() {
            $(this).css("background-color","red");
            });
      
        $("#trolley_submit").mouseout(function() {
            $(this).css("background-color","deepskyblue");
            });
    //clean button
        $("#clean_cart").mouseover(function() {
            $(this).css("background-color","dimgrey");
            });
      
        $("#clean_cart").mouseout(function() {
            $(this).css("background-color","limegreen");
            });
   //product 
        $(".container").on("mouseover",".inner",function() {
            $(this).css("background-color","deeppink");
            $(this).find(".product-title,.description,.product_price").css("color","white");
            
            });
      
        $(".container").on("mouseout",".inner",function() {
            $(this).css("background-color","white");
            $(this).find(".product-title").css("color","black");
            $(this).find(".description").css("color","dimgray");
            $(this).find(".product_price").css("color","red");
            $(this).find(".decoration").css("box-shadow","none");
            });
     //add button   
        $(".container").on("mouseover",".decoration",function(){
            $(this).css("box-shadow","0px 3px 6px lightgray");
        });
    
        $(".container").on("click",".decoration",function(){
            if (!$(this).find(".product_add_button a").is(':animated')) {
                $(this).find(".product_add_button a").animate({"margin":"-100","font-size":"80px"},"slow","swing");
                $(this).find(".product_add_button a").animate({"font-size":"17px"});
            }
        }); 
});