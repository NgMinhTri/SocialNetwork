<!-- start of sidebar -->
<aside class="span4 page-sidebar">
  
  <section class="widget">
    <div class="quick-links-widget">
      <h3 class="title">Liên kết nhanh</h3>
      <ul id="menu-quick-links" class="menu clearfix">
        <li><a href="index.php">Home</a></li>
        <li><a href="home-categories-description.php">Danh mục</a></li>
        <li><a href="tag.php">Tag</a></li>
        <li><a href="ask.php">Đặt câu hỏi</a></li>
      </ul>
    </div>
  </section>

  <section class="widget">
    <h3 class="title">Tags</h3>
    <div class="readLabel">
      <!-- <a href="#" class="btn btn-mini">basic</a> -->
    </div>
  </section>

  <section class="widget">
    <h3 class="title">Danh mục</h3>
    <div class="readCategory"></div>
  </section>
  
</aside>
<!-- end of sidebar -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

  
  $.getJSON("api/label/read.php", function(data){
    var read_label_html = `<div class="tagcloud">`;
    $.each(data.records, function(key, val){             
      read_label_html +=`<a href="#" class="btn btn-mini">` +val.labelName+`</a>`;                    
    });
    read_label_html += `</div>`;
    $(".readLabel").html(read_label_html);
  });

  $.getJSON("api/category/read.php", function(data){
    var read_category_html = `<ul>`;
    $.each(data.records, function(key, val){             
      read_category_html +=`
      <li>
        <a href="category.php?catId=` +val.ID+ `" > ` + val.catName+`</a>
      </li>`;                    
    });
    read_category_html += `</ul>`;
    $(".readCategory").html(read_category_html);
  });
}); 
</script>