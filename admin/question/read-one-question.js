$(document).ready(function(){
 
    $(document).on('click', '.read-one-product-button', function(){

		var ID = $(this).attr('data-id');

		$.getJSON("../api/question/read_one.php?ID=" + ID, function(data){

			var read_one_product_html=`
			 
			    <!-- when clicked, it will show the product's list -->
			    <div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'>
			        <span class='glyphicon glyphicon-list'></span> Xem danh sách câu hỏi
			    </div>

		    	<!-- product data will be shown in this table -->
				<table class='table table-bordered table-hover'>
				 
				    <!-- product name -->
				    <tr>
				        <td class='w-30-pct'>Tiêu đề</td>
				        <td class='w-70-pct'>` + data.Title + `</td>
				    </tr>
				  	<tr>
					    <td>Mô tả</td>
					    <td><textarea rows="8" cols="100" name='description' class='form-control'>` + data.Description + `</textarea></td>
					</tr>
				     <tr>
				        <td class='w-30-pct'>Ngày tạo</td>
				        <td class='w-70-pct'>` + data.CreateDate + `</td>
				    </tr>
				     <tr>
				        <td class='w-30-pct'>Ngày sửa đổi</td>
				        <td class='w-70-pct'>` + data.LastModifiedDate + `</td>
				    </tr>
				     <tr>
				        <td class='w-30-pct'>Số lượng comment</td>
				        <td class='w-70-pct'>` + data.NumberOfComments + `</td>
				    </tr>
				     <tr>
				        <td class='w-30-pct'>Số lượng thích</td>
				        <td class='w-70-pct'>` + data.NumberOfVotes + `</td>
				    </tr>
				     <tr>
				        <td class='w-30-pct'>Số lượng báo cáo</td>
				        <td class='w-70-pct'>` + data.NumberOfReports + `</td>
				    </tr>
				     <tr>
				        <td class='w-30-pct'>Danh mục</td>
				        <td class='w-70-pct'>` + data.catName + `</td>
				    </tr>
				     <tr>
				        <td class='w-30-pct'>UserName</td>
				        <td class='w-70-pct'>` + data.UserName + `</td>
				    </tr>
				 
				    <!-- product description -->
				    <tr>
				        <td class='w-30-pct'>Status</td>
				        <td class='w-70-pct'>` + data.Status + `</td>
				    </tr>
				 
				    				 
				</table>`;
			// inject html to 'page-content' of our app
			$("#page-content").html(read_one_product_html);
			 
			// chage page title
			changePageTitle("Câu hỏi: " + data.Title);
		});
    });
 
});