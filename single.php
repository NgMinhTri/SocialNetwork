 <?php include 'inc/header.php';?>
<?php include 'inc/wrapper.php';?>

<div class="page-container">
    <div class="container">
        <div class="row">
            <!-- start of page content -->
            <div class="span8 page-content">
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Knowledge Base Theme</a><span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#" class="catName"></a>
                        <span class="divider">/</span>
                    </li>
                    <li class="active" id="Title"></li>
                </ul>

                <article class="type-post format-standard hentry clearfix">
                    <h1 class="post-title" id="Title">
                        <!-- <a href="#">Integrating WordPress with Your Website </a> -->
                    </h1>

                    <div class="post-meta clearfix">
                        <span class="date" id="CreateDate"></span>
                        <span class="category"><a href="#" class="catName"></a></span>
                        <span class="comments"><a class="numberComment">0</a> comments</span>
                        <span class="like-count">0</span>
                    </div>

                    <h3>Nội dung</h3>
                    <p id="Description"></p>

                </article>

                <div class="like-btn">
                    <form id="frm_vote" action="#" method="post">
                        <span class="like-it">0</span>
                        <!-- <input  name="post_id" value="99" /> -->
                        <input type="hidden" name="" />
                    </form>
                    <div id="responsevote"></div>
                    <span class="tags">
                        <strong>Tags:</strong>
                        <a id="getLabelInQuestion"></a>

                    </span>
                </div>

                <section id="comments">
                    <h3 id="comments-title"><a class="numberComment">0</a> Bình luận</h3>
                    <div id="listComment"></div>
                </section>

                <div id="respond">
                    <h3>Để lại lời bình luận</h3>

                    <div class="cancel-comment-reply">
                        <a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display: none">Click here
                            to cancel reply.</a>
                    </div>

                    <form action="#" method="post" id="commentform">
                        <p class="comment-notes">
                            Bạn phải đăng nhập để bình luận cho bài viết này<span class="required">*</span>
                        </p>

                        <div>
                            <label for="comment">Comment(tối thiểu 20 kí tự) *</label>
                            <textarea class="span8" minlength="20" name="content" cols="58" rows="10" required></textarea>
                        </div>

                        <div>
                            <input class="btn" type="submit" value="Submit Comment" />
                        </div>
                        </br>
                        <div id="response"></div>
                    </form>
                </div>
            </div>
           <?php include 'inc/sidebar.php';?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>

<script src="admin/assets/js/bootbox.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    var ID = location.search.replace('?questionId=', '');
    LoadCommentFirstpage();
    LoadVotePerQuestion();
    LoadNumberOfComment();
    // reportComment();

    function LoadNumberOfComment() {
        $.getJSON("api/comment/readByQuestionId.php?questionId=" +ID, function(data) {
            var i = 0;
            $.each(data.records, function(key, val) {
                i = i+1;
            });
            $(".numberComment").text(i);
        });
    }

    $.getJSON("api/question/read_one.php?ID=" + ID, function(data) {

        $("#Title").html(`<div>` + data.Title + `</div>`);
        $("#Description").html(`<div>` + data.Description + `</div>`);
        $("#CreateDate").html(`<div>` + data.CreateDate + `</div>`);
        $(".catName").html(`<a>` + data.catName + `</a>`);
    });


    function LoadCommentFirstpage() {
        var json_url = "api/comment/read_paging.php?questionId=" + ID;
        LoadComment(json_url);
        LoadNumberOfComment();
    }

    function LoadComment(json_url) {
        $.getJSON(json_url, function(data) {
           var jwt = getCookie('jwt');
            var read_comment_html = `<ol class="commentlist">`;
            $.each(data.records, function(key, val) {
                read_comment_html += `
                    <li class="comment even thread-even depth-1" id="li-comment-2">
                        <article id="comment-2">
                            <a href="#">
                              <img alt="" src="images/avatar2.png" class="avatar avatar-60 photo" height="60" width="60"/>
                            </a>

                            <div class="comment-meta">
                              <h5 class="author">
                                <cite class="fn">
                                  <a href="#" rel="external nofollow" class="url" >
                                  ` + val.UserName + `
                                  </a>
                                </cite>
                                <a class="comment-reply-link" href="#">- Reply</a>
                              </h5>

                              <p class="date">
                                <a href="#">
                                  <time datetime="2013-02-26T13:18:47+00:00">` + val.createdDate + `</time>
                                </a>
                              </p>
                            </div>
                            <!-- end .comment-meta -->

                            <div class="comment-body">
                              <p>
                                ` + val.content + `
                              </p>
                            </div>
                            <!-- end of comment-body -->
                      </article>
                      <!-- end of comment -->
                    </li>
                    <div id='page-content'></div>`;

                    reportComment();
                    read_comment_html +=`

                    <button type="button" class="btn btn-link reportbtn" data-toggle="modal" data-target="#exampleModal" value=` +
                    val.ID + ` onclick="reportComment()" >Report</button>

                    <button type="button"  name="`+val.ownerUserId+`" class="btn btn-link editbtn" data-toggle="modal" data-id=` + val.ID + `>Sửa</button>

                    <button type="button"  name="`+val.ownerUserId+`" class="btn btn-link deletebtn" data-toggle="modal" data-id=` + val.ID + `>Xóa</button>
                    

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Report answer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form action="#" method="POST" id="reportform">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Loại report</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="Type">
                                                <option value="Spam">Spam</option>
                                                <option value="Bad Content">Bad Content</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Nội dung</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" cols="9"
                                                name="content"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id ="close" class="btn btn-secondary" data-dismiss="modal" onclick ="deletemodel();">Close</button>
                                            <button type="submit" class="btn btn-primary">Send report</button>
                                        </div>
                                        <div id="responsereport"></div>
                                        <div id="responseAutomatically"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> `;
        $.post("api/user/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result){

            if(result.data.id == val.ownerUserId){
                $('button[name="'+val.ownerUserId+'"]').prop("disabled", false);
            }
            else{
                $('button[name="'+val.ownerUserId+'"]').prop("disabled", true);
            }
        });                                   
            });
            read_comment_html += ` </ol>`;
            // pagination
            if (data.paging) {
                read_comment_html += "<ul class='pagination pagination-large'>";

                // first page
                if (data.paging.first != "") {
                    read_comment_html += "<li class='page-item'><a data-page='" + data.paging
                        .first + "'>First Page</a></li>";
                }

                // loop through pages
                $.each(data.paging.pages, function(key, val) {
                    var active_page = val.current_page == "yes" ? "class='active'" : "";
                    read_comment_html += "<li  " + active_page + "><a data-page='" + val
                        .url + "'>" + val.page + "</a></li>";
                });

                // last page
                if (data.paging.last != "") {
                    read_comment_html += "<li class='page-item'><a data-page='" + data.paging.last +
                        "'>Last Page</a></li>";
                }
                read_comment_html += "</ul>";
            }

            $("#listComment").html(read_comment_html);
        });

    }

    $(document).on('click', '.pagination li', function() {

        var json_url = $(this).find('a').attr('data-page');

        LoadComment(json_url);
    });


    //Hàm gửi comment
    $(document).on('submit', '#commentform', function() {

        var createCommentForm = $(this);
        var jwt = getCookie('jwt');
        if (jwt == "") {
            $('#response').html(
                "<div class='alert alert-danger'>Bạn phải đăng nhập để bình luận cho bài viết này!</div>"
            );
        } else {
            var comment = createCommentForm.serializeObject()
            comment.jwt = jwt;
            comment.questionId = ID;
            var form_data = JSON.stringify(comment);

            $.ajax({
                url: "api/comment/create.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function(result) {
                    $('#response').html(
                        "<div class='alert alert-success'>Gửi bình luận thành công!</div>"
                    );
                    LoadCommentFirstpage();
                    refreshModalComment();

                },
                error: function(xhr, resp, text) {
                    $('#response').html(
                        "<div class='alert alert-danger'>Gửi bình luận thất bại!</div>"
                    );
                }
            });
        }

        return false;
    });

    function LoadVotePerQuestion() {
        $.getJSON("api/vote/countNumberPerQuestion.php?questionId=" + ID, function(data) {

            $(".like-count").text(data);
            $(".like-it").text(data);

        });
    }

    //Xử lý Vote
    $('#frm_vote').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var jwt = getCookie('jwt');
        if (jwt == "") {
            $('#responsevote').html(
                "<div class='alert alert-danger'>Bạn phải đăng nhập để vote cho bài viết này!</div>"
            );
        } else {
            var comment = form.serializeObject()
            comment.jwt = jwt;
            comment.questionId = ID;
            var form_data = JSON.stringify(comment);
            $.ajax({
                url: "api/vote/create.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function(result) {
                    LoadVotePerQuestion();
                },
                error: function(xhr, resp, text) {

                    $('#responsevote').html(
                        "<div class='alert alert-danger'>Bạn đã vote cho bài viết này !</div>"
                    );
                }
            });
        }
    });

    $('#frm_vote .like-it').click(function() {
        $('#frm_vote').submit();
    });

    //Get các Tag thuộc câu hỏi
    $.getJSON("api/label/readByQuestionId.php?questionId=" + ID, function(data) {
        var read_tag_html = `<a>`;
        $.each(data.records, function(key, val) {
            read_tag_html += `<a href="label.php?labelId=` + val.ID + `" rel="tag">` + val
                .labelName + `</a>, `;
        });
        read_tag_html += `</a>`;
        $("#getLabelInQuestion").html(read_tag_html);
    });


    $.fn.serializeObject = function() {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
    // Hàm Get Cookie
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
    //Ham report cau tra loi
    $(document).on('submit', '#reportform', function() {

        var createreportForm = $(this);
        var jwt = getCookie('jwt');
        if (jwt == "") {
            $('#responsereport').html(
                "<div class='alert alert-danger'>Bạn phải đăng nhập để report cho câu trả lời này!</div>"
            );
        } else {
            var report = createreportForm.serializeObject()
            report.jwt = jwt;
            report.commentId = commentId;
            var form_data = JSON.stringify(report);
            $.ajax({
                url: "api/report/create.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function(result) {
                    $('#responsereport').html(
                        "<div class='alert alert-success'>Gửi report thành công!</div>"
                    );
                    $.ajax({
                        url: "api/comment/deleteAutomatically.php",
                        type : "DELETE",
                        dataType : 'json',
                        data : JSON.stringify({ ID: commentId }),
                        success : function(result) {                
                            $('#responseAutomatically').html(
                                "<div class='alert alert-success'>Số lượng report lớn hơn hoặc bằng 5 nên comment đã được xóa tự động!</div>"
                            );                           
                        },
                        error: function(xhr, resp, text) {
                            console.log(xhr, resp, text);
                        }
                    }); 
                },
                error: function(xhr, resp, text) {
                    $('#responsereport').html(
                        "<div class='alert alert-danger'>Gửi report thất bại!</div>"
                    );
                }
            });
        }

        return false;
    });

    //Xử lý xóa comment
    $(document).on('click', '.deletebtn', function(){
        var jwt = getCookie('jwt');
        if (jwt == "") {
           bootbox.alert("Bạn phải Login để xóa comment này!");
        } 
        else {
            var ID = $(this).attr('data-id');
            bootbox.confirm({
             
                message: "<h4>Bạn có chắc muốn xóa?</h4>",
                buttons: {
                    confirm: {
                        label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                        className: 'btn-danger'
                    },
                    cancel: {
                        label: '<span class="glyphicon glyphicon-remove"></span> No',
                        className: 'btn-primary'
                    }
                },
                callback: function (result) {
                    if(result==true){
                        $.ajax({
                            url: "api/comment/delete.php",
                            type : "DELETE",
                            dataType : 'json',
                            data : JSON.stringify({ ID: ID }),
                            success : function(result) {                
                                LoadCommentFirstpage();
                                // location.reload();
                            },
                            error: function(xhr, resp, text) {
                                console.log(xhr, resp, text);
                            }
                        });              
                    }
                }
            });
        }        
    });

    //Xử lý edit comment
    $(document).on('click', '.editbtn', function(){
        var jwt = getCookie('jwt');
        if (jwt == "") {
           bootbox.alert("Bạn phải Login để sửa comment này!");
        } 
        else {
            var ID = $(this).attr('data-id');
            $.getJSON("api/comment/readOne.php?ID=" + ID, function(data){
                var content = data.content;
                var update_comment_html=`
                <form action="#" method="post" id="updateCommentform">                      
                    <div>
                        <textarea class="span8" minlength="20" name="content" cols="58" rows="10" required>`+ data.content+`</textarea>
                    </div>
                    <td><input value=\"` + ID + `\" name='ID' type='hidden' /></td>
                    <div>
                        <input class="btn" type="submit" value="Update Comment" />
                    </div>
                    </br>
                </form>`;
                $("#page-content").html(update_comment_html);
            });
        }        
    });

    //Hàm xử lý cập nhật Comment
    $(document).on('submit', '#updateCommentform', function(){

        var form_data=JSON.stringify($(this).serializeObject());

        $.ajax({
            url: "api/comment/update.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result) {
                bootbox.alert("Cập nhật bình luận thành công!");
                LoadCommentFirstpage();
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        });         
        return false;
    });
});

    var commentId = $(".reportbtn").val();
    function reportComment() {
        $(document).ready(function() {
            $(".reportbtn").on("click", function() {
                commentId = $(this).val();
            });
        });
    }

    function deletemodel() {
        $('#exampleModal')
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
            $('#responsereport').html("");      
    }

    function refreshModalComment() {
        $('#commentform')
            .find("textarea")
            .val('')
            .end();  
    }

</script>
