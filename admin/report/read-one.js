$(document).ready(function(){
 
    $(document).on('click', '.read-one-report-button', function(){

		var ID = $(this).attr('data-id');
        $.getJSON("../api/report/readByCommentId.php?commentId=" + ID, function(data){

		var read_report_html=`
        <div class='btn btn-primary pull-right m-b-15px read-reports-button'>
            <span ></span> All comment
        </div>

        <table class='table table-bordered table-hover'>
            <tr>
                <th class='w-15-pct text-align-center'>Nội dung</th>
                <th class='w-10-pct text-align-center'>Ngày tạo</th>
                <th class='w-5-pct text-align-center'>Loại</th>
                <th class='w-5-pct text-align-center'>Người tạo</th>
            </tr>`;

            $.each(data.records, function(key, val) {
    			read_report_html+=`<tr>
     
	            <td>` + val.content + `</td>
	            <td>` + val.CreatedDate + `</td>
            	<td>` + val.Type + `</td>
            	<td>` + val.UserName + `</td>	            
        		</tr>`;	
            });	
            read_report_html+=`</table>`;	
            $("#page-content").html(read_report_html);
             
            changePageTitle("Chi tiết report");
		});		
    });    
});