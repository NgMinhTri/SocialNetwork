$(document).ready(function(){

    $(document).on('click', '.read-one-product-button', function(){
		var ID = $(this).attr('data-id');
		$.getJSON("../api/user/read_one.php?ID=" + ID, function(data){
			var read_one_product_html=`
			 
			    <!-- when clicked, it will show the product's list -->
			    <div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'>
			        <span class='glyphicon glyphicon-list'></span> Xem User
			    </div>

		    	<!-- product data will be shown in this table -->
				<table class='table table-bordered table-hover'>
				 
				    <!-- product name -->
				    <tr>
				        <td class='w-30-pct'>Firstname</td>
				        <td class='w-70-pct'>` + data.firstname + `</td>
				    </tr>
				 
				    <tr>
				        <td class='w-30-pct'>Lastname</td>
				        <td class='w-70-pct'>` + data.lastname + `</td>
				    </tr>

				    <tr>
				        <td class='w-30-pct'>Username</td>
				        <td class='w-70-pct'>` + data.username + `</td>
				    </tr>

				    <tr>
				        <td class='w-30-pct'>Email</td>
				        <td class='w-70-pct'>` + data.email + `</td>
				    </tr>
				 
				    <!-- product description -->
				    <tr>
				        <td>Số điện thoại</td>
				        <td>` + data.phonenumber + `</td>
				    </tr>
				 				    				 
				</table>`;
			$("#page-content").html(read_one_product_html);
		});
    });
 
});