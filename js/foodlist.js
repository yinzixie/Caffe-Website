//js  for master food and beverage page

//confirm operation 
function confirm_operation() {
    return confirm("Confirm your operation!");
}

//reset function

function add_area_reset_button() {
    $("#add_operation_area input[type='text']").each(function(){$(this).val("");});
    }

function edit_area_reset_button() {
    $("#edit_area input[type='text']").each(function(){$(this).val("");});
    }

$(document).ready(function(){
    //default setting
    $("#edit_area").hide();

    //beautify for navigator
    $("#container").on("click",".navigation a",function() {
        $(".option").css("background-color","deepskyblue");
        $(".option a").css("color","white");
        
        $(this).css("color","deepskyblue"); 
        $(this).parent().css("background-color","white");
    });
    
    //show master food list or beverage list
    $("#container").on("click",".navigation .option_masterfood",function() {
       if ($(".master_food_list").css("display")=="none") { // show master food area
                $(".master_food_list").fadeToggle("slow");
            }
        $(".beverage_list").hide();
        $.post("../php/set_master_food_list_state.php");
    });
    
    $("#container").on("click",".navigation .option_beverage",function() {
        if ($(".beverage_list").css("display")=="none") { // show beverage food area
                $(".beverage_list").fadeToggle("slow");
            }
        $(".master_food_list").hide();
        $.post("../php/set_beverage_list_state.php");
    });
    
    //show add area or edit area
    $("#container").on("click",".navigation .option_add",function() {
        $("#add_operation_area").show();
        $("#edit_area").hide();
    });
    
    $("#container").on("click",".navigation .option_edit",function() {
        $("#add_operation_area").hide();
        $("#edit_area").show();
    });
    
    //edit button
    $("#container").on("click",".edit_button",function() {
        $("#add_operation_area").hide();
        $("#edit_area").show();
        $("#iteam_name").attr("value",$(this).parent().parent().find(".food_id").text());
        $("#iteam_name_p").attr("value",$(this).parent().parent().find(".food_id").text());
        
        
        $("#iteam_price").attr("value",parseFloat($(this).parent().parent().find("td:nth-child(2)").text()));
        $("#iteam_description").attr("value",$(this).parent().parent().find("td:nth-child(3)").text());
        $("#iteam_catalogue").val($(this).parent().parent().find("td:nth-child(4)").text());
        $("#iteam_pic_href").attr("value",$(this).parent().parent().find("td:nth-child(5)").text());
        
    });
    
});