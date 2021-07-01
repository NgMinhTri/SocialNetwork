$(document).ready(function(){
 
    showProducts();

	$(document).on('click', '.read-products-button', function(){
	    showProducts();
	});
 
});

function showProducts(){
 
    $.getJSON("../api/question/read.php", function(data){
 
        readProductsTemplate(data, "");
 
        changePageTitle("Danh sách câu hỏi");
 
    });
}
