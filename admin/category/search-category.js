$(document).ready(function(){
 
    $(document).on('submit', '#search-product-form', function(){
 
        var keywords = $(this).find(":input[name='keywords']").val();
 
        $.getJSON("../api/category/search.php?s=" + keywords, function(data){
 
            readProductsTemplate(data, keywords);
 
            changePageTitle("Tìm kiếm danh mục: " + keywords);
 
        });
 
        return false;
    });
 
});