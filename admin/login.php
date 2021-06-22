<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
 <div class="container">
	<section id="content">
		<form action="" method="post" id="login_form_admin">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Email" required="" name="email"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Đăng nhập" />
			</div>
		</form>
		<div class="button">
			<a href="#">Social Network</a> 
		</div>
	</section>
</div>


<script>
$(document).ready(function(){
 	// hàm setup cookie
	function setCookie(cname, cvalue, exdays) {
	    var d = new Date();
	    d.setTime(d.getTime() + (exdays*24*60*60*1000));
	    var expires = "expires="+ d.toUTCString();
	    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	setCookie("jwt", "", 1);   
	 
	 // hàm xử lý khi nhấn nút submit đăng nhập
	$(document).on('submit', '#login_form_admin', function(){	 
	    // lấy dữ liệu form
	    var login_form=$(this);
	    var form_data=JSON.stringify(login_form.serializeObject());
	
	    // submit dữ liệu tới link api 
		$.ajax({
		    url: "../api/admin/login.php",
		    type : "POST",
		    contentType : 'application/json',
		    data : form_data,
		    success : function(result){	 
		        // lưu trữ JWT vào Cookie
		        setCookie("jwt", result.jwt, 1);	 
		        // hiển thị trang index nếu login thành công
		        showIndexPage();	        	 
		    },
		    // lỗi nếu dăng nhập không thành công
		    error: function(xhr, resp, text){
		    alert("Email hoặc mật khẩu không đúng");
		    //login_form.find('input').val('');
			}
		});
	    return false;
	});
 

	// Hàm hiển thị trang Index
	function showIndexPage(){	 
	    // xác thực token
	    var jwt = getCookie('jwt');
	    $.post("../api/admin/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result) {
	         window.location.href ="index.php"; 
	    })
	}

	// Hàm Get Cookie
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
	 
	// hàm biến giá trị form thành dạng json
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
    

    // logout the user
	$(document).on('click', '#logout', function(){
	    showLoginPage();
	    $('#response').html("<div class='alert alert-info'>You are logged out.</div>");
	});
});
</script>
</body>
</html>