
<main role="main" class="container starter-template">
 
    <div class="row">
        <div class="col">
 
            <!-- where prompt / messages will appear -->
            <div id="response"></div>
 
            <!-- where main content will appear -->
            <div id="content">
                <h2>Login</h2>
                        <form id='login_form'>
                            <div class='form-group'>
                                <label for='email'>Email address</label>
                                <input type='email' class='form-control' id='email' name='email' placeholder='Enter email'>
                            </div>
                
                            <div class='form-group'>
                                <label for='password'>Password</label>
                                <input type='password' class='form-control' id='password' name='password' placeholder='Password'>
                            </div>
                
                            <button type='submit' class='btn btn-primary'>Login</button>
                        </form>
                        </div>
        </div>
    </div>
 
</main>
<!-- /container -->
 
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