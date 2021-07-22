<?php include 'inc/header.php';?>
<?php include 'inc/wrapper.php';?>


    <!-- Start of Page Container -->
    <div class="page-container">
      <div class="container">
        <div class="row">
          <!-- start of page content -->
          <div class="span8 page-content">
            <!-- Basic Home Page Template -->
            <!-- <div class="row separator">
              <section class="span4 articles-list">
                <h3>Chủ đề nổi bậc</h3>
                <ul class="articles">
                  <li class="article-entry standard">
                    <h4><a href="single.php">Validating a Website</a></h4>
                    <span class="article-meta"
                      >21 Feb, 2013 in
                      <a href="#" title="View all posts in Website Dev"
                        >Website Dev</a
                      ></span
                    >
                    <span class="like-count">3</span>
                  </li>
                </ul>
              </section>

              <section class="span4 articles-list">
                <h3>Chủ đề mới nhất</h3>
                <ul class="articles">
                  <li class="article-entry standard">
                    <h4>
                      <a href="single.php"
                        >WordPress CSS Information and Techniques</a
                      >
                    </h4>
                    <span class="article-meta"
                      >24 Feb, 2013 in
                      <a href="#" title="View all posts in Theme Development"
                        >Theme Development</a
                      ></span
                    >
                    <span class="like-count">1</span>
                  </li>
                </ul>
              </section>
            </div> -->

            <div class="row home-category-list-area">
              <div class="span8">
                <h2>Danh mục câu hỏi</h2>
              </div>
            </div>

            <div id="showCategory">

              <!-- <section class="span4">
                <h4 class="category"><a href="#">Theme Development</a></h4>
                <div class="category-description">
                  <p>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                    sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                    magna
                  </p>
                </div>
              </section> -->

            </div>


          </div>
          <!-- end of page content -->

          <!-- start of sidebar -->
          <!-- <aside class="span4 page-sidebar">
          
            <section class="widget">
              <h3 class="title">Tags</h3>
              <div class="tagcloud">
                <a href="#" class="btn btn-mini">basic</a>
                <a href="#" class="btn btn-mini">beginner</a>
                <a href="#" class="btn btn-mini">blogging</a>
                <a href="#" class="btn btn-mini">colour</a>
                <a href="#" class="btn btn-mini">css</a>
                <a href="#" class="btn btn-mini">date</a>
                <a href="#" class="btn btn-mini">design</a>
                <a href="#" class="btn btn-mini">files</a>
                <a href="#" class="btn btn-mini">format</a>
                <a href="#" class="btn btn-mini">header</a>
                <a href="#" class="btn btn-mini">images</a>
                <a href="#" class="btn btn-mini">plugins</a>
                <a href="#" class="btn btn-mini">setting</a>
                <a href="#" class="btn btn-mini">templates</a>
                <a href="#" class="btn btn-mini">theme</a>
                <a href="#" class="btn btn-mini">time</a>
                <a href="#" class="btn btn-mini">videos</a>
                <a href="#" class="btn btn-mini">website</a>
                <a href="#" class="btn btn-mini">wordpress</a>
              </div>
            </section>
          </aside> -->
          <!-- end of sidebar -->
          <?php include 'inc/sidebar.php';?>
        </div>
      </div>
    </div>
    <!-- End of Page Container -->
<?php include 'inc/footer.php';?>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

  showAllCategoryFirstpage();

  function showAllCategoryFirstpage(){
    var json_url="api/category/read.php";
    showAllCategory(json_url);    
  }

   function showAllCategory(json_url){

     $.getJSON(json_url, function(data){
      var read_category_html=`<div>`;
        $.each(data.records, function(key, val){             
          read_category_html +=`
            <section class="span4">
                <h4 class="category"><a href="category.php?catId=` + val.ID +`">`+val.catName+`</a></h4>
                <div class="category-description">
                  <p>
                    `+val.description+`
                  </p>
                </div>
              </section>`;                         
        });
      read_category_html+=`</div>`; 
         
          $("#showCategory").html(read_category_html);  
      });
    }
  

});
</script>