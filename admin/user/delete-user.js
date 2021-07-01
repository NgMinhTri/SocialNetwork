$(document).ready(function(){
 
    // will run if the delete button was clicked
    $(document).on('click', '.delete-product-button', function(){
        // product id will be here
        // get the product id
		var ID = $(this).attr('data-id');
		// bootbox for good looking 'confirm pop up'
		bootbox.confirm({
		 
		    message: "<h4>Bạn có chắc muốn xóa?</h4>",
		    buttons: {
		        confirm: {
		            label: '<span class="glyphicon glyphicon-ok"></span> Yes',
		            className: 'btn-danger'
		        },
		        cancel: {
		            label: '<span class="glyphicon glyphicon-remove"></span> No',
		            className: 'btn-primary'
		        }
		    },
		    callback: function (result) {
		    	if(result==true){
				    // send delete request to api / remote server
				    $.ajax({
				        url: "../api/user/delete.php",
				        type : "DELETE",
				        dataType : 'json',
				        data : JSON.stringify({ ID: ID }),
				        success : function(result) {
				 
				            // re-load list of products
				            showProducts();
				        },
				        error: function(xhr, resp, text) {
				            console.log(xhr, resp, text);
				        }
				    });				 
				}
		    }
		});
    });
});