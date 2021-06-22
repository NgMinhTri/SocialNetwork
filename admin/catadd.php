
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục mới</h2>
               <div class="block copyblock"> 
                 <form action="" id="postcategory" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Nhập tên danh mục..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit"  value="Lưu" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>      
<script>
$(document).ready(function(){

    // hàm xử lý khi nhấn nút lưu
    $(document).on('submit', '#postcategory', function(){    
        // lấy dữ liệu form
        var postcategory_form=$(this);
        var form_data=JSON.stringify(postcategory_form.serializeObject());
    
        // submit dữ liệu tới link api 
        $.ajax({
            url: "../api/category/create.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result){  
                alert("Tạo mới danh mục câu hỏi thành công");             
            },
            // lỗi nếu dăng nhập không thành công
            error: function(xhr, resp, text){
                alert("Lỗi");
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

<?php include 'inc/footer.php';?>

