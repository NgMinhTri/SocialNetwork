
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
                <h3>Tất cả câu hỏi</h3>
               <div id="readApproved">                  
                </div>
              </section>



              <section class="span4 articles-list">
                <h3>Câu hỏi mới nhất</h3>
                <div id="readApprovedLastest">                  
                </div>
              </section>
            </div>
          </div>
          <!-- end of page content -->

          <!-- start of sidebar -->
           <div id='create-ask' style="height: 30px;width: 100px;padding: 10px;margin: 20px;font-size: 15px; text-align: center;" class='btn btn-primary pull-right m-b-15px create-ask-button'>
             <a href="ask.php" style="color: white"> Đặt câu hỏi</a>

          </div>
          </br>
          </br>
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
    showQuestionFirstpage();
    function showQuestionFirstpage(){
      var json_url="http://localhost:8080/socialnetwork/api/question/readApprove_paging.php";
      showQuestionLastest(json_url);
     
    }

    function showQuestionLastest(json_url){
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
         read_question_html+=`<ul class="articles">`; 
          // pagination
          if(data.paging){
            read_question_html+="<ul class='pagination'>";
         
                // first page
                if(data.paging.first!=""){
                    read_question_html+="<li class='page-item'><a data-page='" + data.paging.first + "'>First Page</a></li>";
                }
         
                // loop through pages
                $.each(data.paging.pages, function(key, val){
                    var active_page=val.current_page=="yes" ? "class='active'" : "";
                    read_question_html+="<li  " + active_page + "><a data-page='" + val.url + "'>" + val.page + "</a></li>";
                });
         
                // last page
                if(data.paging.last!=""){
                    read_question_html+="<li class='page-item'><a data-page='" + data.paging.last + "'>Last Page</a></li>";
                }
            read_question_html+="</ul>";
          }
          $("#readApprovedLastest").html(read_question_html);  
      });
    }

    $(document).on('click', '.pagination li', function(){
        // get json url
        var json_url=$(this).find('a').attr('data-page');
 
        // show list of products
        showQuestionLastest(json_url);
    });



    // $.getJSON(json_url, function(data){

    //     var read_question_html=`<ul class="articles">`;

    //     $.each(data.records, function(key, val){             
    //       read_question_html+=`
    //         <li class="article-entry standard">
    //           <h4>
    //             <a href="single.php?questionId=` + val.ID +`">` + val.Title +`</a>
    //           </h4>
    //           <span class="article-meta">` + val.CreateDate +`</span>
    //           <span class="like-count">0</span>         
    //         </li>`;  
                        
    //     });
    //      read_question_html+=`<ul class="articles">`; 
    //       $("#readApprovedLastest").html(read_question_html);  
    //   });

    $.getJSON("api/question/readApproved.php", function(data){

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
       read_question_html+=`<ul class="articles">`; 
        $("#readApproved").html(read_question_html);  
    });
     
    
});   
</script>   

