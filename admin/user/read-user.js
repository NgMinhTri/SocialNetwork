$(document).ready(function(){
 
    showProducts();
	$(document).on('click', '.read-products-button', function(){
	    showProducts();
	});
 
});

function showProducts(){
 
    $.getJSON("../api/user/readListUserForAdmin.php", function(data){
        
        readProductsTemplate(data, "");
 
        changePageTitle("Danh sách người dùng");
    });
}
