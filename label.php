
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
              <section class="span8 articles-list">
                <h3 >Các câu hỏi thuộc Tag: <a id="labelName"></a></h3>
              </section> 

              <section class="span4 articles-list">
                <div id="showQuestionByLabel"></div>
              </section>             
            </div>
          </div>
          <?php include 'inc/sidebar.php';?>
        </div>
      </div>
    </div>
    <!-- End of Page Container -->
<?php include 'inc/footer.php';?>
                                 <!-- Code Javascript -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {  

    var ID = location.search.replace('?labelId=', '');
    showQuestionByLabelIDFirstpage();

    function showQuestionByLabelIDFirstpage(){
      var json_url="api/question/readByLabelId.php?labelId=" +ID;
      showQuestionByLabelID(json_url);    
    }

    function showQuestionByLabelID(json_url){

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
          read_question_html+=`<ul>`;
          $("#showQuestionByLabel").html(read_question_html);  
      });
    }

      $.getJSON("api/label/read_one.php?ID=" +ID, function(data){

        $("#labelName").text(data.labelName); 
                        
      });             
});   
</script>   

