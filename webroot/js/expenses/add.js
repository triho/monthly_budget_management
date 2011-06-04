$(document).ready(function(){
    
    $("#expense-date").datepicker();
    
    $("#is-group").click(function(){
        if ($(this).attr("checked")){
            $("#group-name").show();
        }else{
            $("#group-name").hide();
        }
        
    })
});