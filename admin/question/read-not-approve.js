$(document).ready(function(){
 
    showQuestionNotApprove();

	$(document).on('click', '.approve-product-button', function(){
	    showQuestionNotApprove();
	});
 
});

function showQuestionNotApprove(){
 
    $.getJSON("../api/question/read_not_approve.php", function(data){
    	if(data == true){
 
        readQuestionNotApproveTemplate(data, "");
 
        changePageTitle("Danh sách câu hỏi chưa duyệt");
    	}else{
    		// $('#response').html("<div class='alert alert-danger'>Không có câu hỏi chưa được duyệt!</div>");
    		alert("Duyệt câu hỏi thành công");
    	}
 
    });
}
