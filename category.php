
<?php include 'inc/header.php';?>
<?php include 'inc/wrapper.php';?>

    <!-- Start of Page Container -->
    <div class="page-container">
      <div class="container">
        <div class="row">
          <!-- start of page content -->
          <div class="span8 page-content">
            <!-- Basic Home Page Template -->
            <div class="row separator">
              <section class="span4 articles-list">
                <h3 >Các câu hỏi thuộc danh mục: <a id="catName"></a></h3>
                <div id="showQuestionByCategoryID"></div>
              </section>

              
            </div>
          </div>
          <!-- end of page content -->

          

          <aside class="span4 page-sidebar">
            

            <section class="widget">
              <div class="quick-links-widget">
                <h3 class="title">Quick Links</h3>
                <ul id="menu-quick-links" class="menu clearfix">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="articles-list.php">Articles List</a></li>
                  <li><a href="faq.php">FAQs</a></li>
                  <li><a href="contact.php">Contact</a></li>
                </ul>
              </div>
            </section>

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
          </aside>
          <!-- end of sidebar -->
        </div>
      </div>
    </div>
    <!-- End of Page Container -->
<?php include 'inc/footer.php';?>
                                 <!-- Code Javascript -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {  

    var ID = location.search.replace('?catId=', '');
    showQuestionByCategoryIDFirstpage();

    function showQuestionByCategoryIDFirstpage(){
      var json_url="api/question/readByCatId.php?catId=" +ID;
      showQuestionByCategoryID(json_url);    
    }

    

    function showQuestionByCategoryID(json_url){

     $.getJSON(json_url, function(data){

        var read_question_html=`<ul class="articles">`;

        $.each(data.records, function(key, val){             
          read_question_html+=`
            <li class="article-entry standard">
              <h4>
                <a href="single.php?questionId=` + val.ID +`">` + val.Title +`</a>
              </h4>
              <span class="article-meta">` + val.CreateDate +`</span>
              <span class="like-count">0</span>         
            </li>`;  
                        
        });
          $("#showQuestionByCategoryID").html(read_question_html);  
          $("#OK").text(catName);  
      });
    }

      $.getJSON("api/category/read_one.php?ID=" +ID, function(data){

        $("#catName").text(data.catName); 
                        
      });             
});   
</script>   

