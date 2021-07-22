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
                        <h3>Mới nhất trong ngày</h3>
                        <div id="readApprovedLastest"></div>
                    </section>

                    <section class="span4 articles-list">
                        <h3>Tất cả câu hỏi</h3>
                        <div id="readApproved"></div>
                    </section>
                </div>
            </div>
            <!-- end of page content -->

            <!-- start of sidebar -->
            <!-- <div id='create-ask' style="height: 30px;width: 100px;padding: 10px;margin: 20px;font-size: 15px; text-align: center;" class='btn btn-primary pull-right m-b-15px create-ask-button'>
             <a href="ask.php" style="color: white"> Đặt câu hỏi</a> -->
            <div id='create-ask' class='btn btn-primary pull-right m-b-15px create-ask-button'>
                <a href="ask.php" style="color: white"> Đặt câu hỏi</a>

            </div>
            </br>
            </br>

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

    showAllApprovedQuestionFirstpage();
    showLastestApprovedQuestionFirstpage();

    function showAllApprovedQuestionFirstpage() {
        var json_url = "api/question/readApprove_paging.php";
        showAllApprovedQuestion(json_url);
    }

    function showLastestApprovedQuestionFirstpage() {
        var json_url = "api/question/readLastest_paging.php";
        showLastestApprovedQuestion(json_url);
    }

    function showAllApprovedQuestion(json_url) {

        $.getJSON(json_url, function(data) {
            var read_question_html = `<ul class="articles">`;
            $.each(data.records, function(key, val) {
                read_question_html += `<li class="article-entry standard">
              <h4>
                <a href="single.php?questionId=` + val.ID + `">` + val.Title + `</a>
              </h4>
              <span class="article-meta">` + val.CreateDate + ` in
                <a href="#" >` + val.catName + `</a></span>
              <span class="like-count" name="`+val.ID+`"></span>`;
                $.getJSON("api/vote/countNumberPerQuestion.php?questionId=" + val.ID, function(
                    data) {
                    $('span[name="'+val.ID+'"]').text(data);
                });
                
            });
            read_question_html += `         
            </li></ul>`;
            // pagination
            if (data.paging) {
                read_question_html += "<ul class='pagination' id='listQuestion'>";

                // first page
                if (data.paging.first != "") {
                    read_question_html += "<li class='page-item'><a data-page='" + data.paging.first +
                        "'>First Page</a></li>";
                }

                // loop through pages
                $.each(data.paging.pages, function(key, val) {
                    var active_page = val.current_page == "yes" ? "class='active'" : "";
                    read_question_html += "<li  " + active_page + "><a data-page='" + val.url +
                        "'>" + val.page + "</a></li>";
                });

                // last page
                if (data.paging.last != "") {
                    read_question_html += "<li class='page-item'><a data-page='" + data.paging.last +
                        "'>Last Page</a></li>";
                }
                read_question_html += "</ul>";
            }
            $("#readApproved").html(read_question_html);
        });
    }

    function showLastestApprovedQuestion(json_url) {
        $.getJSON(json_url, function(data) {

            var read_question_html = `<ul class="articles">`;

            $.each(data.records, function(key, val) {
                read_question_html += `
            <li class="article-entry standard">
              <h4>
                <a href="single.php?questionId=` + val.ID + `">` + val.Title + `</a>
              </h4>
              <span class="article-meta">` + val.CreateDate + ` in
                <a href="#" >` + val.catName + `</a></span>
                
              <span class="like-count" name="`+val.ID+`"></span>`;
              $.getJSON("api/vote/countNumberPerQuestion.php?questionId=" + val.ID, function(
                    data) {
                    $('span[name="'+val.ID+'"]').text(data);
                });    
                read_question_html+=`</li>`;    
            });
            read_question_html += `<ul class="articles">`;
            // pagination
            if (data.paging) {
                read_question_html += "<ul class='pagination' id='listLastestQuestion'>";

                // first page
                if (data.paging.first != "") {
                    read_question_html += "<li class='page-item'><a data-page='" + data.paging.first +
                        "'>First Page</a></li>";
                }

                // loop through pages
                $.each(data.paging.pages, function(key, val) {
                    var active_page = val.current_page == "yes" ? "class='active'" : "";
                    read_question_html += "<li  " + active_page + "><a data-page='" + val.url +
                        "'>" + val.page + "</a></li>";
                });

                // last page
                if (data.paging.last != "") {
                    read_question_html += "<li class='page-item'><a data-page='" + data.paging.last +
                        "'>Last Page</a></li>";
                }
                read_question_html += "</ul>";
            }
            $("#readApprovedLastest").html(read_question_html);
        });
    }


    $(document).on('click', '#listQuestion li', function() {

        var json_url = $(this).find('a').attr('data-page');

        showAllApprovedQuestion(json_url);
    });

    $(document).on('click', '#listLastestQuestion li', function() {

        var json_url = $(this).find('a').attr('data-page');

        showLastestApprovedQuestion(json_url);
    });
});
</script>
