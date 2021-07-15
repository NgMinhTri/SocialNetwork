<?php include 'inc/header.php';?>
<?php include 'inc/wrapper.php';?>  

<!-- Start of Page Container -->
<div class="page-container">
  <div class="container">
    <div class="row">
      <div class="span8 page-content">
        <div class="row home-category-list-area">
          <div class="span8">
            <h2>Tags</h2>
          </div>
        </div>
        <div id="readLabel"></div>
      </div>
      <?php include 'inc/sidebar.php';?>
    </div>
  </div>
</div>
<?php include 'inc/footer.php';?>

                                  <!-- Code Javascript -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 

  $.getJSON("api/label/read.php", function(data){
    var read_label_html = `<div class="row-fluid top-cats">`;
    $.each(data.records, function(key, val){             
      read_label_html +=`
        <section class="span4">
          <h4 class="category"><a href="label.php?labelId=`+ val.ID +`">`+val.labelName+`</a></h4>
          <div class="category-description">
            <p></p>
          </div>
        </section>`;                    
    });
    read_label_html += `</div>`;
    $("#readLabel").html(read_label_html);
  });
  
}); 
</script>