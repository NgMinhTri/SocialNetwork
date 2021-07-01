$(document).ready(function(){
 
    $(document).on('submit', '#search-product-form', function(){
 
        var keywords = $(this).find(":input[name='keywords']").val();
 
        $.getJSON("../api/question/search.php?s=" + keywords, function(data){
 
            readProductsTemplate(data, keywords);
 
            changePageTitle("Tìm kiếm câu hỏi: " + keywords);
 
        });
 
        return false;
    });
 
});