
function readProductsTemplate(data, keywords){
    var i = 0;
    var read_products_html=`
        <form id='search-product-form' action='#' method='post'>
        <div class='input-group pull-left w-30-pct'>
 
            <input type='text' value='` + keywords + `' name='keywords' class='form-control product-search-keywords' placeholder='Tìm kiếm câu hỏi...' />
 
            <span class='input-group-btn'>
                <button type='submit' class='btn btn-default' type='button'>
                    <span class='glyphicon glyphicon-search'></span>
                </button>
            </span> 
        </div>
        </form>
        </br>
        
        <div id='approve-product' class='btn btn-primary pull-right m-b-15px approve-product-button'>
            <span ></span> Danh sách câu hỏi mới
        </div>
 
        <table class='table table-bordered table-hover'>
            <tr>
                <th class='w-5-pct text-align-center'>STT</th>
                <th class='w-10-pct text-align-center'>Tiêu đề</th>
                <th class='w-25-pct text-align-center'>Mô tả</th>
                
                <th class='w-5-pct text-align-center'>Action</th>
            </tr>`;
    $.each(data.records, function(key, val) {
        i = i + 1;
        read_products_html+=`<tr>
            <td>` + i + `</td>
            <td>` + val.Title + `</td>
            <td>` + val.Description + `</td>            
            <td>
                <!-- read product button -->
                <button class='btn btn-primary m-r-10px read-one-product-button' data-id='` + val.ID + `'>
                    <span class='glyphicon glyphicon-eye-open'></span> Chi tiết
                </button>                            
            </td>
        </tr>`;
    });
 
    read_products_html+=`</table>`;
 
    $("#page-content").html(read_products_html);
}

function readQuestionNotApproveTemplate(data, keywords){
    var i = 0;
    var read_products_html=`
        <form id='search-product-form' action='#' method='post'>
        <div class='input-group pull-left w-30-pct'>
 
            <input type='text' value='` + keywords + `' name='keywords' class='form-control product-search-keywords' placeholder='Tìm kiếm câu hỏi...' />
 
            <span class='input-group-btn'>
                <button type='submit' class='btn btn-default' type='button'>
                    <span class='glyphicon glyphicon-search'></span>
                </button>
            </span>
 
        </div>
        </form>
        </br>
        <div id='approve-product' class='btn btn-primary pull-right m-b-15px read-products-button'>
            <span ></span> Danh sách tất cả câu hỏi
        </div>
 
        <table class='table table-bordered table-hover'>
 
            <!-- creating our table heading -->
            <tr>
                <th class='w-2-pct text-align-center'>STT</th>
                <th class='w-10-pct text-align-center'>Tiêu đề</th>
                <th class='w-20-pct text-align-center'>Mô tả</th>
                
                <th class='w-10-pct text-align-center'>Action</th>
            </tr>`;
 
    $.each(data.records, function(key, val) {
        i = i + 1;
        read_products_html+=`<tr>
 
            <td>` + i + `</td>
            <td>` + val.Title + `</td>
            <td>` + val.Description + `</td>
                       
            <td>
                <!-- Button xem chi tiết câu hỏi -->
                <button class='btn btn-primary m-r-10px read-one-product-button' data-id='` + val.ID + `'>
                    <span class='glyphicon glyphicon-eye-open'></span> Chi tiết
                </button>
 
                <!-- edit button -->
                <button class='btn btn-info m-r-10px update-product-button' data-id='` + val.ID + `'>
                    <span class='glyphicon glyphicon-edit'></span> Duyệt
                </button>

                <!-- delete button -->
                <button class='btn btn-danger delete-product-button' data-id='` + val.ID + `'>
                    <span class='glyphicon glyphicon-remove'></span> Xóa
                </button>
            </td>
        </tr>`;
    });
 
    // end table
    read_products_html+=`</table>`;
 
    // inject to 'page-content' of our app
    $("#page-content").html(read_products_html);
}