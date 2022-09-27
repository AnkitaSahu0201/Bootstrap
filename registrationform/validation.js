$(document).ready(function(){
    var $reg_name=/^[a-zA-Z]+$/;
    var $reg_email= /^[a-zA-Z0-9._]{3,}@[a-zA_Z]{3,}[.]{1}[a-zA-Z]{2,6}$/;
    var $reg_pswd= /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    var $reg_empcode = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
    
    $('#empname').on('keyup',function(){
        $('.errormsg1').hide();
        if (!$(this).val().match($reg_name)) { // there is a mismatch, hence hide the previous error msg and show the regex error messag
            $('.errormsg1').removeClass('hidden');
            $('.errormsg1').show();
            $('.errormsg1').html("please enter only characters").css({
                "color":"red"
            });
        }  
        else{
            // else, do not display message
            $('.errormsg1').removeClass('hidden');
            $('.errormsg1').hide();
           }
    });
    $('#email').on('keyup',function(){
        $('.errormsg2').hide();
        if (!$(this).val().match($reg_email)) { // there is a mismatch, hence hide the previous error msg and show the regex error messag
            $('.errormsg2').removeClass('hidden');
            $('.errormsg2').show();
            $('.errormsg2').html("please enter valid email").css({
                "color":"red"
            });
        }  
        else{
            // else, do not display message
            $('.errormsg2').removeClass('hidden');
            $('.errormsg2').hide();
           }
    });
    $('#pswd').on('keyup',function(){
        $('.errormsg3').hide();
        if (!$(this).val().match($reg_pswd)) { // there is a mismatch, hence hide the previous error msg and show the regex error messag
            $('.errormsg3').removeClass('hidden');
            $('.errormsg3').show();
            $('.errormsg3').html("Password should contain : Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special characters ").css({
                "color":"red"
            })
        }  
        else{
            // else, do not display message
            $('.errormsg3').removeClass('hidden');
            $('.errormsg3').hide();
           }
    });
    $('#empcode').on('keyup',function(){
        $('.errormsg4').hide();
        if (!$(this).val().match($reg_empcode)) { // there is a mismatch, hence hide the previous error msg and show the regex error messag
            $('.errormsg4').removeClass('hidden');
            $('.errormsg4').show();
            $('.errormsg4').html("Employee Code should contain: Minimum six characters, at least one letter and one number:").css({
                "color":"red"
            });
        }  
        else{
            // else, do not display message
            $('.errormsg4').removeClass('hidden');
            $('.errormsg4').hide();
           }
    });
});
