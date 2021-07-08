<?php include 'inc/header.php';?>
<?php include 'inc/wrapper.php';?>
<script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <!-- Start of Page Container -->
    <div class="page-container">
      <div class="container">
        <div class="row">	
          <!-- start of page content -->
          <div class="span8 page-content">
            <article class="type-page hentry clearfix">
              <h1 class="post-title"> <a href="#">Câu hỏi</a></h1>                     
            </article>

            <form id="createQuestionForm" class="row" action="" method="post">

                <div class="span2"> <label for="name">Tiêu đề<span>*</span> </label></div>
                <div class="span6">
                  <input type="text" required name="Title" id="Title" class="required input-xlarge" value="" title="*Nhập tiêu đề"
                  />
                </div>

                <div class="span2"><label for="email">Danh mục<span>*</span></label></div>
                <div class="span6">
                  <input type="text" required name="category" id="category" class="required input-xlarge"
                    title="* Chọn danh mục"/>
                </div>

                <div class="span2"><label for="message">Mô tả <span>*</span> </label></div>
                <div class="span6">
                  <textarea name="Description" required id="Description" class="required span6" rows="20"  title="* Nhập mô tả câu hỏi"></textarea>
                </div>

                <div class="span2"><label for="attachment">Tệp đính kèm</label></div>
                <div class="span6" id="attachment_items">
                	<a id="btn_add_attachment" href="#" class="btn btn-success" style="margin: 3px; margin-left: 0px">Thêm đính kèm</a>
                </div>

                </br>

                <div class="span6 offset2 bm30">
                  <input type="submit" name="submit" value="Tạo câu hỏi" class="btn btn-inverse"/>
                </div>
                <div id="response"></div>
              <!-- <div class="span6 offset2 error-container"></div>
              <div class="span8 offset2" id="message-sent"></div> -->
            </form>
          </div>        
        </div>
      </div>
    </div>

<?php include 'inc/footer.php';?>
<script type="text/javascript">
$(document).ready(function() {	

  	

    // $(document).on('submit', '#createQuestionForm', function(){    
    //     var addcategory_form=$(this);
    //     var form_data=JSON.stringify(addcategory_form.serializeObject());    
        
    //     $.ajax({
    //         url: "../api/question/create.php",
    //         type : "POST",
    //         contentType : 'application/json',
    //         data : form_data,
    //         success : function(result){  
    //         //alert("Thêm danh mục câu hỏi thành công");
    //         $('#response').html("<div class='alert alert-success'>Đặt câu hỏi thành công.</div>");

                          
    //         }
    //         // lỗi nếu dăng nhập không thành công
    //         error: function(xhr, resp, text){
    //         $('#response').html("<div class='alert alert-danger'>Đặt câu hỏi thất bại. Vui lòng thử lại.</div>");
    //         }
    //     });
    //     return false;
    // });
     
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
    
    CKEDITOR.replace('Description');
    $('#btn_add_attachment').off('click').on('click', function(){
      $('#attachment_items').prepend('<p><input type="file"  name="attachment" /></p>');
      return false;
    });
});		
</script>