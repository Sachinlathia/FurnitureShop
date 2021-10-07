
jQuery.noConflict();
jQuery(document).ready(function()
{
    jQuery("#passFiled").hide();
    jQuery("#btnChangePass").hide();

    //---------------------------------------closing buttons---
    jQuery("#passClose").on('click',function(){
        location.reload();location.reload();
    })
    jQuery("#closeReg").on('click',function(){
        location.reload();location.reload();
    })
    jQuery("#RegisterBtn").on('click',function(){
        var name= jQuery("#UnosUsername").val();
        
        if(name == ""){
            jQuery("#username_error").html('You must enter a name');
            jQuery("#username_error").css('color','red');
            return false;
        }
        else{
            jQuery("#username_error").html('');
        }
        var email= jQuery("#UnosEmail1").val();
        var regemail = /^[A-z\d.\-_]+@[A-z]+\.[a-z]{2,3}/;
        if(email == ""){
            jQuery("#email_error").html('You must enter email');
            jQuery("#email_error").css('color','red');
            return false;
        }
        else if(!(email.match(regemail))){
            jQuery("#email_error").html('Wrong email format');
            jQuery("#email_error").css('color','red');
            return false;
        }
        else{
            jQuery("#email_error").html('');
        }
        var pw1 = jQuery("#UnosPW1").val();
        
        if(pw1 ==""){
            jQuery("#pw_error").html('You must enter a password');
            jQuery("#pw_error").css('color','red');
            return false;
        }
        
        else{
            jQuery("#pw_error").html('');
        }
        
        var pw2 = jQuery('#UnosPW2').val();
        if(pw2!=pw1){
            jQuery("#pw2_error").html('Both passwords must match');
            jQuery("#pw2_error").css('color','red');
            return false;
        }
        else {
            jQuery("#pw2_error").html('');
            
        }

        jQuery.ajax({
            type:'POST',
            url:'phpskripte/register.php',
            data:jQuery("#registerForm").serialize(),
            success:function(result)
            {
                

                if(result.status=='fail'){
                    jQuery("#email_error").html('Email already exists');
                    jQuery("#email_error").css('color','red');
                     
                }
                else if(result.status=='success')
                {
                    jQuery("#msg").html('You sucessfuly registrated');
                    jQuery("#registerForm")[0].reset()
                }
            }
        });
    })
    //---------------------------Verify email-----------------------
    jQuery("#verifyBtn").on('click',function(){

        var verifyUserEmail = jQuery("#email_verify").val();
        
        var regemail1 = /^[A-z\d.\-_]+@[A-z]+\.[a-z]{2,3}/;
        if(verifyUserEmail == ""){
            jQuery("#email_error1").html('You must enter email');
            jQuery("#email_error1").css('color','red');
            return false;
        }
        else if(!(verifyUserEmail.match(regemail1))){
            jQuery("#email_error1").html('Wrong email format');
            jQuery("#email_error1").css('color','red');
            return false;
        }
        else{
            
            jQuery.ajax({
                type:'POST',
                url:'phpskripte/verifyEmail.php',
                data:jQuery("#forwardPw").serialize(),
                success:function(result)
                {
                    
    
                    if(result.status=='success'){
                        jQuery("#verifyBtn").hide();
                        jQuery("#email_error1").html('');
                        jQuery("#passFiled").show(500);
                        jQuery("#btnChangePass").show();
                         
                    }
                    else if(result.status=='fail')
                    {
                        jQuery("#msg1").html('Entered email doesn\'t exist, try again.');
					    jQuery("#msg1").css('color','red');
                    }
                }
            });
        }
    });

//--------------------------EmailPassVerify.............-===----

jQuery("#btnChangePass").on('click',function(){
    var verifyUserEmail = jQuery("#email_verify").val();
    var regemail1 = /^[A-z\d.\-_]+@[A-z]+\.[a-z]{2,3}/;
        if(verifyUserEmail == ""){
            jQuery("#email_error1").html('You must enter email');
            jQuery("#email_error1").css('color','red');
            return false;
        }
        else if(!(verifyUserEmail.match(regemail1))){
            jQuery("#email_error1").html('Wrong email format');
            jQuery("#email_error1").css('color','red');
            return false;
        }
        else
	{
		jQuery("#email_error1").html('');

	}

    var password = jQuery("#noviPass").val();	
    if(password ==""){
        jQuery("#pw_error").html('You must enter a password');
        jQuery("#pw_error").css('color','red');
        return false;
    }
    
    else{
        jQuery("#pw_error").html('');

        jQuery.ajax({
            type:'POST',
            url:'phpskripte/UpdatePass.php',
            data:jQuery("#forwardPw").serialize(),
            success:function(result){
                if(result.status=='success'){
                   jQuery("#pw_error").html('');
					jQuery("#msg1").html('Your password is successfully changed.');
					jQuery("#msg1").css('color','green');
					jQuery("#btnChangePass").hide();
                }
                else if(result.status=='fail'){
                    jQuery("#msg1").html('Something went wrong');
					    jQuery("#msg1").css('color','red');
                }
                //alert(result);
            }
        });
    }

});

//-------------------------------LOGIN CONFIRMATION------------------------------------------

jQuery("#loginBtn").on('click',function(){

    var loginEmail = jQuery("#loginEmail").val();
    var loginPw = jQuery("#loginPassword").val();

    var regemail_login = /^[A-z\d.\-_]+@[A-z]+\.[a-z]{2,3}/;
        if(loginEmail == ""){
            jQuery("#loginEmailError").html('You must enter emial');
            jQuery("#loginEmailError").css('color','red');
            return false;
        }
        else if(!(loginEmail.match(regemail_login))){
            jQuery("#loginEmailError").html('Wrong format of email');
            jQuery("#loginEmailError").css('color','red');
            return false;
        }
        else{
            jQuery("#loginEmailError").html('');
        }

        if(loginPw ==""){
            jQuery("#loginPasswordError").html('You must enter a password');
            jQuery("#loginPasswordError").css('color','red');
            return false;
        }
        else{
            jQuery("#loginPasswordError").html('');
        }

});

})
