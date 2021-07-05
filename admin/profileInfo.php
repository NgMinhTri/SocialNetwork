<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootbox.min.js"></script>
<script src="appAdmin.js"></script>
<link href="assets/css/style.css" rel="stylesheet" />


<?php include 'inc/header.php';?>
<main>
   	<div class="container-fluid px-4">
      
     		<h3 class="mt-4">Thông tin Admin</h3>
     			<table class='table table-bordered table-hover'>
  	            <tr>
  	                <th class='w-10-pct'>Firstname</th>
  	                <th class='w-10-pct'>Lastname</th>
  	                <th class='w-25-pct'>Email</th>

  	                <th class='w-5-pct text-align-center'>Action</th>
  	            </tr>
  	            <tr>
	                   <td id="fname"></td>
            		    <td id="lname"></td>
                    <td id="email"></td>
                    <td id="action"></td>
  	            </tr>
          </table>
      <div id="app"></div>
   	</div>
</main>
<?php include 'inc/footer.php';?>  

<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
<script type="text/javascript">
	$(document).ready(function() {
	
    $.getJSON("../api/admin/profile.php", function(data) {
    	var read_admin_profile=`
		<button class='btn btn-primary m-r-10px edit-admin-button' data-id='` + data.Id + `'>
        <span class='glyphicon glyphicon-eye-open'></span> Cập nhật
    	</button> `;
        $("#fname").html(`<div>` + data.firstname + `</div>`);
        $("#lname").html(`<div>` + data.lastname + `</div>`);
        $("#email").html(`<div>` + data.email + `</div>`);
        $("#action").html(read_admin_profile);
    });


    $(document).on('click', '.edit-admin-button', function(){

      var Id = $(this).attr('data-id');
      $.getJSON("../api/admin/read_one.php?Id=" + Id, function(data){    
          var firstname = data.firstname;
          var lastname = data.lastname;
          var email = data.email;        
        var update_admin_html=`
          <form id='update-admin-form' action='#' method='post' border='0'>
              <table class='table table-hover table-responsive table-bordered'>        
                  <tr>
                      <td>Firstname</td>
                      <td><input value=\"` + firstname + `\" type='text' name='firstname' class='form-control' required /></td>
                  </tr>
                            
                  <tr>
                      <td>Lastname</td>
                      <td><input value=\"` + lastname + `\" type='text' name='lastname' class='form-control' required /></td>
                  </tr> 

                  <tr>
                      <td>Email</td>
                      <td><input value=\"` + email + `\" type='email' name='email' class='form-control' required /></td>
                  </tr>                         
           
                  <tr>           
                      <td><input value=\"` + Id + `\" name='Id' type='hidden' /></td>       
                      <td>
                          <button type='submit' class='btn btn-info'>
                              <span class='glyphicon glyphicon-edit'></span> Cập nhật 
                          </button>
                      </td>          
                  </tr>          
              </table>
          </form>`;
        $("#page-content").html(update_admin_html); 
        changePageTitle("Cập nhật thông tin Admin");             
      });
    });
     
  $(document).on('submit', '#update-admin-form', function(){
       
    var form_data=JSON.stringify($(this).serializeObject());
    $.ajax({
        url: "../api/admin/update.php",
        type : "POST",
        contentType : 'application/json',
        data : form_data,
        success : function(result) {

            alert("Cập nhật thông tin admin thành công");
            window.location.href ="profileInfo.php"; 
        },
        error: function(xhr, resp, text) {

            console.log(xhr, resp, text);
        }
    });      
      return false;
  });
});	
</script>