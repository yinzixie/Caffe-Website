// js for account page
 
//back to user's information area
function back() {
    if(!$(".profile").is(':animated')) {
        $(".profile").animate({left:'0cm',top:'0cm',opacity:'1'});
        $(".charge_area").animate({right:'0cm',bottom:'14.5cm',opacity:'0.5'});;
        $(".profile").css("z-index","0");
        $(".charge_area").css("z-index","-1");
        }
}

$(document).ready(function(){

    //go to charge area
    $("#show").click(function(){
        if(!$(".profile").is(':animated')) {
            $(".profile").animate({left:'13cm',top:'0.5cm',opacity:'0.5'});
            $(".charge_area").animate({right:'13cm',bottom:'15cm',opacity:'1'});
            $(".profile").css("z-index","-1");
            $(".charge_area").css("z-index","0");
        }
        
    });
});