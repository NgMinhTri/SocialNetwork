<?php include 'inc/header.php';?>
<main>                  
<div class="container-fluid px-4"> 
    <h1 class="mt-4">Danh sách danh mục câu hỏi</h1>
    <div id="response"></div>  
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase mb-0">Quản lý danh mục</h5>
                        </div>
                        <div class="table-responsive">
                          <table id="categoryTable" class="table no-wrap user-table mb-0">
                              <thead>
                                <tr>
                                  <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                  <th scope="col" class="border-0 text-uppercase font-medium">Tên danh mục</th>
                                  <th scope="col" class="border-0 text-uppercase font-medium">Mô tả</th>
                                  
                                  <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>
                                </tr>
                              </thead>

                             <!--  <tbody>
                                
                                <tr>
                                   
                                  <td class="pl-4">STT</td>
                                  <td>
                                      <h5 class="font-medium mb-0">   </h5>                                     
                                  </td>
                                  
                                  <td>
                                      <span class="text-muted">     </span><br>
                                      
                                  </td>
                                  
                                  <td>
                                    
                                    <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-trash"></i> </button>
                                    <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-edit"></i> </button>
                                    
                                  </td>
                                </tr>

                              </tbody> -->
                          </table>
                         
                        </div>
                         
                    </div>
                </div>
            </div>
        </div> 

</div>        
</main>
<?php include 'inc/footer.php';?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 
   
     $.ajax({
          url: "../api/category/read.php",
          type : "GET",
          contentType : 'application/json',
          dataType: 'json',
          success : function(categories){            
             console.log(categories.records); 
             var catList = ' ';  
             for (i = 0; i < categories.records.length; i++) {
                catList += '<tr>';
                catList += '<td class="pl-4">'+ i +'</td>' ;
                catList += '<td>';
                catList += '<h5 class="font-medium mb-0">'+categories.records[i].catName+ '</h5>'; 
                catList += '</td>';

                catList += '<td>';
                catList += '<span class="text-muted">'+categories.records[i].description+ '</span>'; 
                catList += '</td>';

                catList += '<td>';
                catList += '<button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2">'; 
                catList += '<i class="fa fa-trash">';
                catList += '</i>';
                catList += '</button>';

                catList += '<button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2">'; 
                catList += '<i class="fa fa-edit">';
                catList += '</i>';
                catList += '</button>';
                catList += '</td>';
                catList += '</tr>'

              }
              $('#categoryTable').append(catList); 
          },
          error: function(xhr, resp, text){
          $('#response').html("<div class='alert alert-danger'>Danh mục câu hỏi trống!</div>");
          }
      }); 
                            
});
</script>


<style type="text/css">
body{
    background: #edf1f5;
    margin-top:20px;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: 0;
}
.btn-circle.btn-lg, .btn-group-lg>.btn-circle.btn {
    width: 50px;
    height: 50px;
    padding: 14px 15px;
    font-size: 18px;
    line-height: 23px;
}
.text-muted {
    color: #8898aa!important;
}
[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
    cursor: pointer;
}
.btn-circle {
    border-radius: 100%;
    width: 40px;
    height: 40px;
    padding: 10px;
}
.user-table tbody tr .category-select {
    max-width: 150px;
    border-radius: 20px;
}
</style>

                