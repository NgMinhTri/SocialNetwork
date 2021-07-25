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
                        <h3>Các câu hỏi thuộc danh mục: <a id="catName"></a></h3>
                    </section>
                    <section class="span8 articles-list">

                        <label for="sort">Sắp xếp theo:</label>
                        <select id="sort">
                            <option class="op" value="newest">Mới nhất</option>
                            <option class="op" value="oldest">Cũ nhất</option>
                            <option class="op" value="mostlike">Nhiều lượt vote nhất</option>
                            <option class="op" value="today">Hôm nay</option>
                        </select>


                    </section>
                    <section class="span4 articles-list">
                        <div id="showQuestionByCategoryID"></div>
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

    var ID = location.search.replace('?catId=', '');
    showQuestionByCategoryIDFirstpage();

    function showQuestionByCategoryIDFirstpage() {
        var json_url = "api/question/readByCatId.php?catId=" + ID;
        showQuestionByCategoryID(json_url);
        // var selectedOptionVal = $('#sort').find(":selected").val();
        // console.log(selectedOptionVal);
        $('select').on('change', function() {
            $("#showQuestionByCategoryID").html("");
            if (this.value =="mostlike"){
                showQuestionByCategoryID("api/question/readByCatIdOrderByVote.php?catId=" + ID);
            }
            else if(this.value=="newest"){
                showQuestionByCategoryID(json_url);
            }
            else if(this.value=="today"){
                showQuestionByCategoryID("api/question/readLastestByCatId.php?catId=" + ID);
            }
            else if(this.value=="oldest"){
                showQuestionByCategoryID("api/question/readByCatIdFromOldest.php?catId=" + ID);
            }
        });
        //showQuestionByCategoryID(json_url);
    }

    function showQuestionByCategoryID(json_url) {

        $.getJSON(json_url, function(data) {
            var read_question_html = `<ul class="articles">`;

            $.each(data.records, function(key, val) {
                read_question_html += `
            <li class="article-entry standard">
              <h4>
                <a href="single.php?questionId=` + val.ID + `">` + val.Title + `</a>
              </h4>
              <span class="article-meta">` + val.CreateDate + `</span>
              <span class="like-count" name="` + val.ID + `"></span>        
            </li>`;
                $.getJSON("api/vote/countNumberPerQuestion.php?questionId=" + val.ID, function(
                    data) {
                    $('span[name="' + val.ID + '"]').text(data);
                });
            });
            $("#showQuestionByCategoryID").html(read_question_html);
            $("#OK").text(catName);
        });
    }

    $.getJSON("api/category/read_one.php?ID=" + ID, function(data) {

        $("#catName").text(data.catName);

    });
});
</script>