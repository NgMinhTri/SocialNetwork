
<?php include 'inc/header.php';?>
<?php include 'inc/wrapper.php';?>
<!-- Start of Page Container -->
<div class="page-container">
  <div class="container">
    <div class="row">	
      <!-- start of page content -->
      <div class="span8 page-content">
        <article class="type-page hentry clearfix">
          <h1 class="post-title"> <a href="#">Câu hỏi</a></h1>                     
        </article>
             <form action="#" method="post" id="commentform">                                
                  <div>
                    <label >Tiêu đề *</label>
                    <input class="span4" type="text" name="Title" minlength="10" size="22" required />
                  </div>

                  <div >
                    <label >Danh mục *</label>
                    <select id="Category" name='catId' class='span4'  required></select>
                  </div>


                  <div>
                    <label >Mô tả *</label>
                    <textarea id="Description" class="span8" required name="Description" cols="58" rows="10" required></textarea>
                  </div>

                  <div>
                    <label >Nhập tag cho câu hỏi *</label>
                    <input class="span4" type="text" name="labelName" size="22" required />
                  </div>

                  </br>

                  <div>
                    <input class="btn"  type="submit" value="Gửi câu hỏi"/>
                  </div>
                   </br>
                  <div id="response"></div>
            </form>   

      </div>   
      <?php include 'inc/sidebar.php';?>        
    </div>
  </div>
</div>
<?php include 'inc/footer.php';?>

<script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {  

    $.getJSON("api/category/read.php", function(data){
        var categories_options_html=`<select>`;
            $.each(data.records, function(key, val){
                categories_options_html+=`<option value='` + val.ID + `'>` + val.catName + `</option>`;
            });
            categories_options_html+=`</select>`;
            $("#Category").html(categories_options_html);
    });


    $(document).on('submit', '#commentform', function(){           
        var addquestion_form = $(this);
        var jwt = getCookie('jwt');
        var createQuestion = addquestion_form.serializeObject()
        createQuestion.jwt = jwt;

        var form_data = JSON.stringify(createQuestion);
        $.ajax({
            url: "api/question/createTag.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result){  
                $('#response').html("<div class='alert alert-success'>Đặt câu hỏi thành công.Vui lòng đợi Admin duyệt </div>");                         
            },
            error: function(xhr, resp, text){
                $('#response').html("<div class='alert alert-danger'>Đặt câu hỏi thất bại. Vui lòng thử lại.</div>");
                }
        });
        return false;
    });
     
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
    // CKEDITOR.replace('Description');
    // $('#btn_add_attachment').off('click').on('click', function(){
    //   $('#attachment_items').prepend('<p><input type="file"  name="attachment" /></p>');
    //   return false;
    // });
});     
</script>
