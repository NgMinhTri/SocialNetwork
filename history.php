<head>
    <link rel="stylesheet" href="css/history.css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <meta charset="utf-8">
</head>
<!------ Include the above in your HEAD tag ---------->

<?php include 'inc/header.php'; ?>


<div class="page-container">
    <div class="container">


        <section class="content">
            <h1>History</h1>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="pull-right">
                        <div class="btn-group">
                            <button id="Question-bnt" type="button" class="btn btn-success btn-filter"
                                data-target="pagado">Question</button>
                            <button id="Answer-bnt" type="button" class="btn btn-warning btn-filter"
                                data-target="pendiente">Answer</button>
                        </div>
                    </div></br> </br> </br></br>
                    <div class="table-container">
                        <!-- <table class="table table-filter"> -->

                        <div id="question"></div>
                        <!-- </tbody> -->
                        <!-- </table> -->
                    </div>

                </div>
            </div>
        </section>


    </div>
</div>


<script>
$(document).ready(function() {
    var jwt = getCookie('jwt');
    $.post("api/user/validate_token.php", JSON.stringify({
        jwt: jwt
    })).done(function(result) {
        var html = "";
        $(document).on('click', '#Question-bnt', function() {
            $("#question").html("");
            // categories api call will be here
            console.log(result.data.id);
            $.getJSON("api/user/reportQuestions.php?id=" + result
                .data.id,
                function(data) {
                    var i =1;
                    html = `<tbody>
                    <tr data-status="question" class="selected">
                        <td class ="ta">
                            <h5>Số thứ tự</h5><hr>
                        </td>
                        <td class ="ta">
                            <h5>Trạng thái</h5><hr>
                        </td>
                        <td class ="ta">
                            <h5>Tiêu đề</h5><hr>
                        </td>
                       
                        <td class ="ta">
                            <h5>Ngày đặt câu hỏi</h5><hr>
                        </td>
                    </tr></tbody>`;
                    $.each(data.records, function(key, val) {
                        // read products button will be here
                        html += `<tbody>
                    <tr data-status="question" class="selected">
                        <td >
                            <h6>` + i + `</h6>
                        </td>`;
                        if (val.Status == 1) {
                            html += `<td >
                                    <a>Đã duyệt</a>
                                </td>`
                        } else {
                            html += `<td >
                                    <a>Chờ duyệt</a>
                                </td>`
                        }

                        html+=`<td >
                                <div class="media">
                                    <div class="media-body">   
                                    <u > 
                                        <a href="single.php?questionId=` + val.id + `">` + val.Title + `</a>             
                                    </u>                                                    
                                    </div>
                                </div>
                            </td>
                            
                            <td >
                                <a>` + val.CreateDate + `</a>
                            </td>
                            </tr> </tbody>`;
                            i++;
                    });
                    $("#question").html(html);
                });
        });
        $(document).on('click', '#Answer-bnt', function() {
            // categories api call will be here
            $("#question").html("");
            console.log(result.data.id);
            $.getJSON("api/user/reportAnswer.php?id=" + result
                .data.id,
                function(data) {
                    var i=1;
                    html = `<tbody>
                    <tr data-status="question" class="selected">
                        <td class ="ta">
                            <h5>Số thứ tự</h5><hr>
                        </td>
                        <td class ="ta">
                            <h5>Tiêu đề</h5><hr>
                        </td>
                        <td class ="ta">
                            <h5>Câu hỏi</h5><hr>
                        </td>
                        <td class ="ta">
                            <h5>Câu trả lời</h5><hr>
                        </td>
                        <td class ="ta">
                            <h5>Ngày trả lời</h5><hr>
                        </td>
                    </tr></tbody>`;
                    $.each(data.records, function(key, val) {
                        // read products button will be here
                        html += `<tbody>
                    <tr data-status="question" class="selected">
                                        <td class ="ta">
                                                <h6>` + i + `</h6>
                                        </td>
                                        <td class ="ta">
                                            <u style="font-weight:bold;"><a href="single.php?questionId=` + val.QuestionId + `">` + val
                            .Question + `</a>  </u>
                                        </td>
                                        <td class ="ta">
                                            <h5>` + val.Description + `</h5>
                                        </td>
                                        <td class ="ta">                                                          
                                            <h5> ` + val.Content + `
                                            </h5>                                                    
                        
                                        </td>
                                        <td class ="ta">
                                            <h5>` + val.CreateDate + `</h5>
                                        </td>
                            </tr> </tbody>`;
                            i++;
                    });
                    $("#question").html(html);
                });

        });

    })
    // const xhr = new XMLHttpRequest();
    // xhr.open('GET', 'http://localhost/SOCIALNETWORK/api/user/read.php')
    // xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8')
    // xhr.send(JSON.stringify(jwt))
    // $.getJSON("http://localhost/SOCIALNETWORK/api/user/read.php",function(data){
    //     $("#fname").html(`<div>` + data.firstname + `</div>`);
    //     $("#lname").html(`<div>` + data.lastname + `</div>`);
    //     $("#email").html(`<div>` + data.email + `</div>`);
    //     $("#username").html(`<div>` + data.username + `</div>`);
    //     $("#phone").html(`<div>` + data.phonenumber + `</div>`);
    //     $("#fullname").html(`<div>` + data.firstname + `</div>`);
    // });

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }

            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
});
</script>


<?php include 'inc/footer.php'; ?>