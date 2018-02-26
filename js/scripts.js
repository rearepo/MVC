$(document).ready(function() {
    if ( _DONE === true ){
        return;
    }             
    _DONE = true;

    $("#register_container").hide();
	$(function(){
		$("#signup").on("click", function(e){
            $("#register_container").toggle();
			e.preventDefault();
		});
    });
    
    function validateEmail($email) {
         var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,6})?$/
        return emailReg.test( $email );
      }

    $("#register").click(function() {
        var name = $("#name").val();
        var email = $("#email1").val();
        var password1 = $("#password1").val();
        var password2 = $("#password2").val();
        if (name == '' || email == '' || password1 == '' || password2 == '') {
            event.stopImmediatePropagation();
            alert("Please fill all fields!");
            return false;
        } else if(name.length < 4) {
            event.stopImmediatePropagation();
            alert("Name must be at least 4 characters in length!");
            return false;
        } else if(!validateEmail(email)) {
            event.stopImmediatePropagation();
            alert ("Invalid email address. Please enter a valid email address!");
            return false;
        } else if ((password1.length) < 8) {
            event.stopImmediatePropagation();
            alert("Password should at least 8 character in length!");
            return false;
        } else if (password1!=password2) {
            event.stopImmediatePropagation();
            alert("Your passwords don't match. Try again.");
            return false;
        } else {
            $.post("?controller=home&action=index", {
            name: name,
            email: email,
            password1: password1
        }, 
        function(data,status) {  
         
        });
        }
    });
   
});

