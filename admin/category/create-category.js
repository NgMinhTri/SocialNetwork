$(document).ready(function(){
 
    // show html form when 'create product' button was clicked
    $(document).on('click', '.create-product-button', function(){

			var create_product_html=`
			 
			    <!-- 'read products' button to show list of products -->
			    <div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'>
			        <span class='glyphicon glyphicon-list'></span> Xem danh mục
			    </div>

			    <!-- 'create product' html form -->
				<form id='create-product-form' action='#' method='post' border='0'>
				    <table class='table table-hover table-responsive table-bordered'>
				 
				        <!-- name field -->
				        <tr>
				            <td>Tên danh mục</td>
				            <td><input type='text' name='catName' class='form-control' required /></td>
				        </tr>
				 
				        
				 
				        <!-- description field -->
				        <tr>
				            <td>Mô tả</td>
				            <td><textarea name='description' class='form-control' required></textarea></td>
				        </tr>
				 
				       
				 
				        <!-- button to submit form -->
				        <tr>
				            <td></td>
				            <td>
				                <button type='submit' class='btn btn-primary'>
				                    <span class='glyphicon glyphicon-plus'></span> Tạo danh mục
				                </button>
				            </td>
				        </tr>
				 
				    </table>
				</form>`;

				// inject html to 'page-content' of our app
				$("#page-content").html(create_product_html);
				 
				// chage page title
				changePageTitle("Tạo danh mục");
		 
		
    });
 
    // 'create product form' handle will be here
    // will run if create product form was submitted
	$(document).on('submit', '#create-product-form', function(){
	    // form data will be here
	    // get form data
		var form_data=JSON.stringify($(this).serializeObject());
		// submit form data to api
		$.ajax({
		    url: "../api/category/create.php",
		    type : "POST",
		    contentType : 'application/json',
		    data : form_data,
		    success : function(result) {
		        // product was created, go back to products list
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