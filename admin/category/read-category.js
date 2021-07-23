$(document).ready(function(){
    showProducts();
	$(document).on('click', '.read-products-button', function(){
	    showProducts();
	});
 
});

function showProducts(){
    $.getJSON("../api/category/read.php", function(data){
        readProductsTemplate(data, "");
        changePageTitle("Danh sách danh mục");
    });
}
