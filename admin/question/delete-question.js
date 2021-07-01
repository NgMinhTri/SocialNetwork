$(document).ready(function(){
 
    $(document).on('click', '.delete-product-button', function(){

		var ID = $(this).attr('data-id');
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
		    	if(result == true){
				    $.ajax({
				        url: "../api/question/delete.php",
				        type : "DELETE",
				        dataType : 'json',
				        data : JSON.stringify({ ID: ID }),
				        success : function(result) {
				 
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