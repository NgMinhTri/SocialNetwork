// product list html
function readProductsTemplate(data, keywords){
 
    var read_products_html=`
        <!-- search products form -->
        <form id='search-product-form' action='#' method='post'>
        <div class='input-group pull-left w-30-pct'>
 
            <input type='text' value='` + keywords + `' name='keywords' class='form-control product-search-keywords' placeholder='Tìm kiếm người dùng...' />
 
            <span class='input-group-btn'>
                <button type='submit' class='btn btn-default' type='button'>
                    <span class='glyphicon glyphicon-search'></span>
                </button>
            </span>
 
        </div>
        </form>
        </br>
        <!-- when clicked, it will load the create product form -->
        
 
        <!-- start table -->
        <table class='table table-bordered table-hover'>
 
            <!-- creating our table heading -->
            <tr>
                <th class='w-10-pct'>Username</th>
                <th class='w-15-pct'>Email</th>
                <th class='w-10-pct'>Số điện thoại</th>

                <th class='w-5-pct text-align-center'>Action</th>
            </tr>`;
 
 
    // loop through returned list of data
    $.each(data.records, function(key, val) {
 
        // creating new table row per record
        read_products_html+=`<tr>
 
            <td>` + val.username + `</td>
            <td>` + val.email + `</td>
            <td>` + val.phonenumber + `</td>
 
            <!-- 'action' buttons -->
            <td>
                <!-- read product button -->
                <button class='btn btn-primary m-r-10px read-one-product-button' data-id='` + val.ID + `'>
                    <span class='glyphicon glyphicon-eye-open'></span> Chi tiết
                </button>
 
            </td>
        </tr>`;
    });
 
    // end table
    read_products_html+=`</table>`;
 
    // inject to 'page-content' of our app
    $("#page-content").html(read_products_html);
}