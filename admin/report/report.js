// product list html
function readReportTemplate(data){
    var i = 0;
    var read_report_html=`

        <table class='table table-bordered table-hover'>
            <tr>
                <th class='w-5-pct text-align-center'>STT</th>
                <th class='w-15-pct text-align-center'>Nội dung</th>
                <th class='w-10-pct text-align-center'>Ngày tạo</th>
                
                <th class='w-5-pct text-align-center'>Action</th>
            </tr>`;
 
    $.each(data.records, function(key, val) {
        i = i + 1;
        read_report_html+=`<tr>
            <td>` + i + `</td>
            <td>` + val.content + `</td>
            <td>` + val.createdDate + `</td>
            
            <td>
                <button class='btn btn-primary m-r-10px read-one-report-button' data-id='` + val.ID + `'>
                    <span class='glyphicon glyphicon-eye-open'></span> Chi tiết
                </button>

                <button class='btn btn-danger m-r-10px delete-report-button' data-id='` + val.ID + `'>
                    <span class='glyphicon glyphicon-eye-open'></span> Xóa
                </button>                                
            </td>
        </tr>`;
    });

    read_report_html+=`</table>`;
    $("#page-content").html(read_report_html);
}

