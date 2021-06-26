
<?php include 'inc/header.php';?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Thêm danh mục mới</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Static Navigation</li>
                        </ol>
                      
                        <form id='addCategory_form'>
                            <div class="form-group">
                                <label for="firstname">Nhập tên danh mục</label>
                                <input  type="text" class="form-control" name="catName" id="namecategory" required/>
                            </div>
                            <div class="form-group">
                                <label for="firstname">Nhập mô tả</label>
                                
                            </div>
                             <textarea  required id="description" name="description" rows="8" cols="100"></textarea>
                            </br>
                            <div id="response"></div>
                            </br>
                            <button type='submit' class='btn btn-primary'>Lưu</button>
                            <div id="response"></div>
                        </form>
                        
            
                    </div>
                </main>

<?php include 'inc/footer.php';?>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script>
$(document).ready(function(){       
     // hàm xử lý khi nhấn nút Lưu
    $(document).on('submit', '#addCategory_form', function(){    
        // lấy dữ liệu form
        var addcategory_form=$(this);
        var form_data=JSON.stringify(addcategory_form.serializeObject());
    
        // submit dữ liệu tới link api 
        $.ajax({
            url: "../api/category/create.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result){  
            //alert("Thêm danh mục câu hỏi thành công");
            // $('#response').html("<div class='alert alert-success'>Thêm danh mục câu hỏi thành công.</div>");
            if(result === 2){
                $('#response').html("<div class='alert alert-danger'>Danh mục câu hỏi đã tồn tại. Vui lòng thử lại!</div>");
                }
            else if(result === 1){
                $('#response').html("<div class='alert alert-success'>Thêm danh mục câu hỏi thành công.</div>");  
                }
                console.log(result);
                          
            }
            // lỗi nếu dăng nhập không thành công
            // error: function(xhr, resp, text){
            // $('#response').html("<div class='alert alert-danger'>Thêm danh mục câu hỏi thất bại. Vui lòng thử lại.</div>");
            // }
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
