$(document).ready(function(){
 
    // handle 'read one' button click
    $(document).on('click', '.read-one-product-button', function(){
        // product ID will be here
        // get product id
		var ID = $(this).attr('data-id');
		// read product record based on given ID
		$.getJSON("../api/category/read_one.php?ID=" + ID, function(data){
		    // read products button will be here
		    // start html
			var read_one_product_html=`
			 
			    <!-- when clicked, it will show the product's list -->
			    <div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'>
			        <span class='glyphicon glyphicon-list'></span> Xem danh mục
			    </div>

		    	<!-- product data will be shown in this table -->
				<table class='table table-bordered table-hover'>
				 
				    <!-- product name -->
				    <tr>
				        <td class='w-30-pct'>Tên danh mục</td>
				        <td class='w-70-pct'>` + data.catName + `</td>
				    </tr>
				 
				    
				 
				    <!-- product description -->
				    <tr>
				        <td>Mô tả</td>
				        <td>` + data.description + `</td>
				    </tr>
				 
				    				 
				</table>`;
			// inject html to 'page-content' of our app
			$("#page-content").html(read_one_product_html);
			 
			// chage page title
			changePageTitle("Tạo danh mục");
		});
    });
 
});