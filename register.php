
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V16</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Register
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" id='sign_up_form'>

					<div class="wrap-input100 validate-input" data-validate = "First Name">
						<input class="input100" type="text" name="firstname" placeholder="First Name" required>
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>
                    <div class="wrap-input100 validate-input" data-validate = "Last Name">
						<input class="input100" type="text" name='lastname' placeholder="Last Name" required>
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>
                    <div class="wrap-input100 validate-input" data-validate = "Email">
						<input class="input100" type="email" name='email' placeholder="Email" required>
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>
                    <div class="wrap-input100 validate-input" data-validate = "Username">
						<input class="input100" type="text" name='username' placeholder="User name" required>
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>
                    <div class="wrap-input100 validate-input" data-validate = "Phone Number">
						<input class="input100" type="text" name='phonenumber' placeholder="Phone Number" required>
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn">
							Register
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	

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

    // trigger when registration form is submitted
$(document).on('submit', '#sign_up_form', function(){
 
 // get form data
 var sign_up_form=$(this);
 var form_data=JSON.stringify(sign_up_form.serializeObject());

 // submit form data to api
 $.ajax({
     url: "api/user/create_user.php",
     type : "POST",
     contentType : 'application/json',
     data : form_data,
     success : function(result) {
         // if response is a success, tell the user it was a successful sign up & empty the input boxes
         $('#response').html("<div class='alert alert-success'>Successful sign up. Please login.</div>");
         sign_up_form.find('input').val('');
         window.location.replace('log-in.php');
     },
     error: function(xhr, resp, text){
         // on error, tell the user sign up failed
         $('#response').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
     }
 });

 return false;
});
 
    // show login form trigger will be here
 
    // clearResponse() will be here
    // remove any prompt messages
 
// showLoginPage() will be here
 
// serializeObject will be here
// function to make form values to json format
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