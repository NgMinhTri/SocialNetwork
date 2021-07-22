<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V16</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" id='login_form'>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="email" name='email' placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
                    <div id='response'></div>
                    <div class="d-flex justify-content-center links">
					Don't have an account?<a href="register.php">Sign Up</a>
				    </div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	

<!--===============================================================================================-->
<!-- script links will be here -->
<!-- jQuery & Bootstrap 4 JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
<!-- jquery scripts will be here -->
<script>
// jQuery codes

$(document).ready(function(){
    // show sign up / registration form
    
    setCookie("name", "", 1);
    setCookie("jwt", "", 1);

    // trigger when registration form is submitted
    $(document).on('submit', '#login_form', function(){
 
 // get form data
    var login_form=$(this);
    var form_data=JSON.stringify(login_form.serializeObject());
    $.ajax({
    url: "api/user/login.php",
     type : "POST",
     contentType : 'application/json',
     data : form_data,
     success : function(result) {
         
        setCookie("jwt", result.jwt, 1);
         // if response is a success, tell the user it was a successful sign up & empty the input boxes
         $('#response').html("<div class='alert alert-success'>Successful log in.</div>");
         login_form.find('input').val('');
         var jwt = getCookie('jwt');
        $.post("api/user/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result) {
            setCookie("name", result.data.username, 1);
            window.location.replace('index.php');
        // home page html will be here
    })
         
    },
     error: function(xhr, resp, text){
         // on error, tell the user sign up failed
         $('#response').html("<div class='alert alert-danger'>Incorrect Username or Password</div>");
     }
    });
    // http request will be here

    return false;
});
// function to set cookie
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname){
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' '){
            c = c.substring(1);
        }
 
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
// submit form data to api
$.fn.serializeObject = function(){
 
 var o = {};
 var a = this.serializeArray();
 $.each(a, function() {
     if (o[this.name] !== undefined) {
         if (!o[this.name].push) {
             o[this.name] = [o[this.name]];
         }
         o[this.name].push(this.value || '');
     } else {
         o[this.name] = this.value || '';
     }
 });
 return o;
};
});
</script>
</body>
</html>