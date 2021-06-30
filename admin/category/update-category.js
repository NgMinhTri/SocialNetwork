$(document).ready(function(){
 
    // show html form when 'update product' button was clicked
    $(document).on('click', '.update-product-button', function(){
        // product ID will be here
        // get product id
		var ID = $(this).attr('data-id');
		// read one record based on given product id
		$.getJSON("../api/category/read_one.php?ID=" + ID, function(data){
		 
		    // values will be used to fill out our form
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
					 
					        <!-- name field -->
					        <tr>
					            <td>Tên danh mục</td>
					            <td><input value=\"` + catName + `\" type='text' name='catName' class='form-control' required /></td>
					        </tr>
					 					        
					        <!-- description field -->
					        <tr>
					            <td>Mô tả</td>
					            <td><textarea name='description' class='form-control' required>` + description + `</textarea></td>
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
					// inject to 'page-content' of our app
					$("#page-content").html(update_product_html);
					 
					// chage page title
					changePageTitle("Cập nhật danh mục");
			
		});

    });
     
    // 'update product form' submit handle will be here
    // will run if 'create product' form was submitted
	$(document).on('submit', '#update-product-form', function(){
	     
	    // get form data will be here 
	    // get form data
		var form_data=JSON.stringify($(this).serializeObject());
		// submit form data to api
		$.ajax({
		    url: "../api/category/update.php",
		    type : "POST",
		    contentType : 'application/json',
		    data : form_data,
		    success : function(result) {
		        // product was created, go back to products list
		        alert("Cập nhật danh mục thành công");
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