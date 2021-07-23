
function readProductsTemplate(data, keywords){
    var i = 0;
    var read_products_html=`
        <!-- search products form -->
        <form id='search-product-form' action='#' method='post'>
        <div class='input-group pull-left w-30-pct'>
 
            <input type='text' value='` + keywords + `' name='keywords' class='form-control product-search-keywords' placeholder='Tìm kiếm danh mục...' />
 
            <span class='input-group-btn'>
                <button type='submit' class='btn btn-default' type='button'>
                    <span class='glyphicon glyphicon-search'></span>
                </button>
            </span>
 
        </div>

        </form>
        </br>
        <!-- when clicked, it will load the create product form -->
        <div id='create-product' class='btn btn-primary pull-right m-b-15px create-product-button'>
            <span class='glyphicon glyphicon-plus'></span> Tạo danh mục
        </div>
 
        <!-- start table -->
        <table class='table table-bordered table-hover'>
 
            <!-- creating our table heading -->
            <tr>
                <th class='w-2-pct text-align-center'>STT</th>
                <th class='w-10-pct text-align-center'>Tên danh mục</th>
                <th class='w-25-pct text-align-center'>Mô tả</th>

                <th class='w-10-pct text-align-center'>Action</th>
            </tr>`;
 
    $.each(data.records, function(key, val) {
        i = i + 1;
        read_products_html+=`<tr>
            <td>` + i  + `</td>
            <td>` + val.catName + `</td>
            <td>` + val.description + `</td>

 
            <!-- 'action' buttons -->
            <td>
                <!-- read product button -->
                <button class='btn btn-primary m-r-10px read-one-product-button' data-id='` + val.ID + `'>
                    <span class='glyphicon glyphicon-eye-open'></span> Chi tiết
                </button>
 
                <!-- edit button -->
                <button class='btn btn-info m-r-10px update-product-button' data-id='` + val.ID + `'>
                    <span class='glyphicon glyphicon-edit'></span> Sửa
                </button>
 
                <!-- delete button -->
                <button class='btn btn-danger delete-product-button' data-id='` + val.ID + `'>
                    <span class='glyphicon glyphicon-remove'></span> Xóa
                </button>
            </td>
        </tr>`;
    });
    read_products_html+=`</table>`;
    $("#page-content").html(read_products_html);
}