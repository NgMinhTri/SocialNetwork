$(document).ready(function(){
    $(document).on('click', '.update-product-button', function(){
		var ID = $(this).attr('data-id');
		$.getJSON("../api/category/read_one.php?ID=" + ID, function(data){
		    var catName = data.catName;
		    var description = data.description;
		     
			var update_product_html=`
			    <div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'>
			        <span class='glyphicon glyphicon-list'></span> Xem danh mục
			    </div>
			    <!-- build 'update product' html form -->

				<!-- we used the 'required' html5 property to prevent empty fields -->
				<form id='update-product-form' action='#' method='post' border='0'>
				    <table class='table table-hover table-responsive table-bordered'>
				 
				        <tr>
				            <td>Tên danh mục</td>
				            <td><input value=\"` + catName + `\" type='text' name='catName' class='form-control' required /></td>
				        </tr>
				 					        
				        <tr>
				            <td>Mô tả</td>
				            <td><textarea rows="8" cols="100" name='description' class='form-control' required>` + description + `</textarea></td>
				        </tr>					 					        
				 
				        <tr>
				 
				            <!-- hidden 'product id' to identify which record to delete -->
				            <td><input value=\"` + ID + `\" name='ID' type='hidden' /></td>
				 
				            <!-- button to submit form -->
				            <td>
				                <button type='submit' class='btn btn-info'>
				                    <span class='glyphicon glyphicon-edit'></span> Cập nhật danh mục
				                </button>
				            </td>
				 
				        </tr>
				 
				    </table>
				</form>`;
				$("#page-content").html(update_product_html);
				changePageTitle("Cập nhật danh mục");
			
		});

    });
	$(document).on('submit', '#update-product-form', function(){
		var form_data=JSON.stringify($(this).serializeObject());
		$.ajax({
		    url: "../api/category/update.php",
		    type : "POST",
		    contentType : 'application/json',
		    data : form_data,
		    success : function(result) {
		        alert("Cập nhật danh mục thành công");
		        showProducts();
		    },
		    error: function(xhr, resp, text) {
		        console.log(xhr, resp, text);
		    }
		});	     
	    return false;
	});
});