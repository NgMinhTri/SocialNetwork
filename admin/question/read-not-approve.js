$(document).ready(function(){
 
    showQuestionNotApprove();

	$(document).on('click', '.approve-product-button', function(){
	    showQuestionNotApprove();
	});
 
});

function showQuestionNotApprove(){
 
    $.getJSON("../api/question/read_not_approve.php", function(data){
 
        readQuestionNotApproveTemplate(data, "");
 
        changePageTitle("Danh sách câu hỏi chưa duyệt");
    	
 
    });
}
