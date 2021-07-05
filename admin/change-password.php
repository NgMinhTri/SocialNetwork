
<?php include 'inc/header.php';?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">           
            <hr class="mb-5">
                <div class="col-md-6 offset-md-3">
                    <span class="anchor" id="formChangePassword"></span>
                    <hr class="mb-5">

                    <!-- form card change password -->
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Thay đổi mật khẩu</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" id="change-password" >
                                <!-- <div class="form-group">
                                    <label for="inputPasswordOld">Mật khẩu hiện tại</label>
                                    <input type="password" class="form-control" id="inputPasswordOld" required="">
                                </div> -->
                                <div class="form-group">
                                    <label for="inputPasswordNew">Mật khẩu mới</label>
                                    <input type="password" name="password" class="form-control" id="inputPasswordNew" required="">
                                    <span class="form-text small text-muted">
                                            Mật khẩu phải từ 8-20 kí tự và <em>không</em> chứa khoảng trắng!
                                        </span>
                                </div>
                                <div id="response"></div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg float-right">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                            
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){  

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

    $(document).on('submit', '#change-password', function(){    

        var change_password_form=$(this);
        var jwt = getCookie('jwt');
        var change_password_form_obj = change_password_form.serializeObject();
         change_password_form_obj.jwt = jwt;
        
        var form_data = JSON.stringify(change_password_form_obj);
        
        $.ajax({
            url: "../api/admin/change-password.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result){  

            $('#response').html("<div class='alert alert-success'>Thêm danh mục câu hỏi thành công.</div>");
            
                          
            }
            // lỗi nếu dăng nhập không thành công
            error: function(xhr, resp, text){
            $('#response').html("<div class='alert alert-danger'>Thêm danh mục câu hỏi thất bại. Vui lòng thử lại.</div>");
            }
        });
        return false;
    });
     
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
});   
</script>
          