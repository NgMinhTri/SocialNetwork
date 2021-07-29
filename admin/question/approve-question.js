$(document).ready(function(){
 
    $(document).on('click', '.update-product-button', function(){

		var ID = $(this).attr('data-id');
		$.getJSON("../api/question/read_one.php?ID=" + ID, function(data){
		 
		    var Title = data.Title;
		    var Description = data.Description;
		    var CreateDate= data.CreateDate;
		    var LastModifiedDate = data.LastModifiedDate;
		    var Status = data.Status;
		    var catName = data.catName;
		    var UserName = data.UserName;
		    $.getJSON("../api/label/readByQuestionId.php?questionId=" + ID, function(data) {
			    var read_tag_html = `<a>`;
			    $.each(data.records, function(key, val) {
			        read_tag_html += `<a>` + val.labelName + `</a>, `;
			    });
			    read_tag_html += `</a>`;
			    var a= $("#getLabelInQuestionApprove").html(read_tag_html);
		    });
		     
				var update_product_html=`
				    <div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'>
				        <span class='glyphicon glyphicon-list'></span> Xem danh sách câu hỏi
				    </div>
				    <!-- build 'update product' html form -->

					<!-- we used the 'required' html5 property to prevent empty fields -->
					<form id='update-product-form' action='#' method='post' border='0'>
					    <table class='table table-hover table-responsive table-bordered'>
					 
					        <tr>
					            <td>Tiêu đề</td>
					            <td><input value=\"` + Title + `\" type='text' name='Title' class='form-control' required /></td>
					        </tr>
					 					        	        
					        <tr>
					            <td>Mô tả</td>
					            <td><textarea rows="8" cols="100" name='Description' class='form-control' required>` + Description + `</textarea></td>
					        </tr>					 					        
					 		
					 		<tr>
					            <td>Ngày tạo</td>
					            <td><input value=\"` + CreateDate + `\" type='text' name='' class='form-control' required /></td>
					        </tr>

					        

					        <tr>
					            <td>Danh mục</td>
					            <td><input value=\"` + catName + `\" type='text' name='' class='form-control' required /></td>
					        </tr>

					        <tr>
					            <td>Tag</td>
					            <td id='getLabelInQuestionApprove'></td>
					        </tr>

					        <tr>
					            <td>UserName</td>
					            <td><input value=\"` + UserName + `\" type='text' name='' class='form-control' required /></td>
					        </tr>

					       
					        <tr>
					 
					            <!-- hidden 'product id' to identify which record to delete -->
					            <td><input value=\"` + ID + `\" name='ID' type='hidden' /></td>
					 
					            <!-- button to submit form -->
					            <td>
					                <button type='submit' class='btn btn-info'>
					                    <span class='glyphicon glyphicon-edit'></span> Duyệt câu hỏi
					                </button>
					            </td>
					 
					        </tr>
					 
					    </table>
					</form>`;

					

					$("#page-content").html(update_product_html);
					 
					changePageTitle("Duyệt câu hỏi: " +Title);
			
		});

    });
     
	$(document).on('submit', '#update-product-form', function(){
	     
		var form_data=JSON.stringify($(this).serializeObject());
		// submit form data to api
		$.ajax({
		    url: "../api/question/approve.php",
		    type : "POST",
		    contentType : 'application/json',
		    data : form_data,
		    success : function(result) {
		        // product was created, go back to products list
		        alert("Duyệt câu hỏi thành công");
		        showProducts();
		    },
		    error: function(xhr, resp, text) {
		        // show error to console
		        console.log(xhr, resp, text);
		    }
		});
	     
	    return false;
	});
});