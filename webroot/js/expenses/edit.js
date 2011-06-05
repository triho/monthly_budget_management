$(document).ready(function(){
    $("#expense-date").datepicker();
    
    if ($("#is-group").attr("checked")){
            $("#group-name").show();
        }else{
            $("#group-name").hide();
        }
});

