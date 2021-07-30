<head>
    <link rel="stylesheet" href="css/topboard/util.css" />
    <link rel="stylesheet" href="css/topboard/main.css" />

</head>

<?php include 'inc/header.php';?>
<?php include 'inc/wrapper.php';?>
<div class="page-container">
    <div class="container">
        <h2>Bảng xếp hạng tháng <?php echo date('m')?></h2>
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100 ver1 m-b-110">
                    <div class="table100-head">
                        <table>
                            <thead>
                                <tr class="row100 head">
                                    <th class="cell100 column1">Tiêu đề</th>
                                    <th class="cell100 column3">Danh mục</th>
                                    <th class="cell100 column4">Ngày tạo</th>
                                    <th class="cell100 column5">Số vote</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="showtopboard"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include 'inc/footer.php';?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    showQuestionByCategoryID('api/question/topQuestionInMonth.php');

    function showQuestionByCategoryID(json_url) {
        $.getJSON(json_url, function(data) {
            var read_question_html = `<div class="table100-body js-pscroll">
                        <table>
                            <tbody>`;

            $.each(data.records, function(key, val) {
                read_question_html += `
                <tr class="row100 body">
                                    <td class="cell100 column1"><a href="single.php?questionId=` + val.ID + `">` + val.Title + `</a></td>
                                    <td class="cell100 column3">` + val.catName + `</td>
                                    <td class="cell100 column4">` + val.CreateDate + `</td>
                                    <td class="cell100 column5">` + val.likes + `</td>
                </tr>`;
            });
            read_question_html += `</tbody>
                    </table>`;
            $("#showtopboard").html(read_question_html);
            $("#OK").text(catName);
        });
    }
})
</script>