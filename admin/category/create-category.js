$(document).ready(function(){
    $(document).on('click', '.create-product-button', function(){
			var create_product_html=`
			 
			    <!-- 'read products' button to show list of products -->
			    <div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'>
			        <span class='glyphicon glyphicon-list'></span> Xem danh mục
			    </div>

			    <!-- 'create product' html form -->
				<form id='create-product-form' action='#' method='post' border='0'>
				    <table class='table table-hover table-responsive table-bordered'>
				 
				        <tr>
				            <td>Tên danh mục</td>
				            <td><input type='text' name='catName' class='form-control' required /></td>
				        </tr>
				 				        				 
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
				$("#page-content").html(create_product_html);				 
				changePageTitle("Tạo danh mục");		 		
    });
 
	$(document).on('submit', '#create-product-form', function(){

		var form_data=JSON.stringify($(this).serializeObject());

		$.ajax({
		    url: "../api/category/create.php",
		    type : "POST",
		    contentType : 'application/json',
		    data : form_data,
		    success : function(result) {
		        showProducts();
		    },
		    error: function(xhr, resp, text) {
		        console.log(xhr, resp, text);
		    }
		});
		 
		return false;
	});
});