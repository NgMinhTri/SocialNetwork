$(document).ready(function(){
 
    showReport();

	$(document).on('click', '.read-reports-button', function(){
	    showReport();
	});
 
});

function showReport(){
 
    $.getJSON("../api/comment/readIsReported.php", function(data){
 
        readReportTemplate(data);
 
        changePageTitle("Danh sách comment bị báo xấu");
 
    });
}
