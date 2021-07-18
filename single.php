<?php //include 'inc/header.php';?>



<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en-US"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en-US">
<!--<![endif]-->

<head>
    <!-- META TAGS -->

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Social Network</title>
    <link rel="shortcut icon" href="images/favicon.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Google Web Fonts-->
    <link
        href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
        rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet'
        type='text/css'>

    <!-- Style Sheet-->
    <link rel="stylesheet" href="style.css" />
    <!-- <link rel='stylesheet' id='bootstrap-css-css'  href='css/bootstrap.css?ver=1.0' type='text/css' media='all' /> -->
    <!-- <link rel='stylesheet' id='responsive-css-css'  href='css/responsive.css?ver=1.0' type='text/css' media='all' /> -->
    <link rel='stylesheet' id='pretty-photo-css-css' href='js/prettyphoto/prettyPhoto.css?ver=3.1.4' type='text/css'
        media='all' />
    <link rel='stylesheet' id='main-css-css' href='css/main.css?ver=1.0' type='text/css' media='all' />
    <link rel="stylesheet" href="css/profile.css" />
</head>

<body>
    <!-- Start of Header -->
    <div class="header-wrapper">
        <header>
            <div class="container">
                <div class="logo-container">
                    <!-- Website Logo -->
                    <a href="index.php" title="Knowledge Base Theme">
                        <img src="images/logo.png" alt="Knowledge Base Theme" />
                    </a>
                    <span class="tag-line">Social Network</span>
                </div>

                <!-- Start of Main Navigation -->
                <nav class="main-nav">
                    <div class="menu-top-menu-container">
                        <ul id="menu-top-menu" class="clearfix">
                            <li class="current-menu-item"><a href="index.php">Trang chủ</a></li>
                            <li><a href="home-categories-description.php">Danh mục câu hỏi</a></li>
                            <!-- <li><a href="home-categories-articles.php">Home 3</a></li> -->
                            <li><a href="articles-list.php">Articles List</a></li>
                            <li><a href="faq.php">FAQs</a></li>
                            <li>
                                <a href="#">Skins</a>
                                <ul class="sub-menu">
                                    <li><a href="./blue-skin.php">Blue Skin</a></li>
                                    <li><a href="./green-skin.php">Green Skin</a></li>
                                    <li><a href="./red-skin.php">Red Skin</a></li>
                                    <li><a href="./index.php">Default Skin</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">More</a>
                                <ul class="sub-menu">
                                    <li><a href="full-width.php">Full Width</a></li>
                                    <li><a href="elements.php">Elements</a></li>
                                    <li><a href="page.php">Sample Page</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.php">Liên hệ</a></li>
                            <?php if($_COOKIE['jwt']==""){
                    echo "
                      <li>
                      <a href='#'>Login/ Register</a>
                      <ul class='sub-menu'>
                        <li><a href='log-in.php'>Login</a></li>
                        <li><a href='register.php'>Register</a></li>
                      </ul>
                      </li>";
                      
                    }
                    else {
                      echo "
                      <li>
                      <a href='#'>";
                      echo $_COOKIE['name'];
                      echo
                      "</a>
                      <ul class='sub-menu'>
                        <li><a href='profile.php'>Profile</a></li>
                        <li><a href='history.php'>History</a></li>
                        <li><a href='log-in.php'>Logout</a></li>
                      </ul>
                      </li>";}
                ?>

                        </ul>
                    </div>
                </nav>
                <!-- End of Main Navigation -->
            </div>
        </header>
    </div>
    <!-- End of Header -->
    <?php include 'inc/wrapper.php';?>

    <!-- Start of Page Container -->
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
                        <p id="Description">

                        </p>

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
                                <label for="comment">Comment *</label>
                                <textarea class="span8" name="content" cols="58" rows="10" required></textarea>
                            </div>

                            <div>
                                <input class="btn" type="submit" value="Submit Comment" />
                            </div>
                            </br>
                            <div id="response"></div>
                        </form>
                    </div>
                </div>
                </aside>
            </div>
        </div>
    </div>

    <?php include 'inc/footer.php';?>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

    <script type="text/javascript">
    $(document).ready(function() {

        var ID = location.search.replace('?questionId=', '');
        LoadCommentFirstpage();
        LoadVotePerQuestion();

        $.getJSON("api/question/read_one.php?ID=" + ID, function(data) {

            $("#Title").html(`<div>` + data.Title + `</div>`);
            $("#Description").html(`<div>` + data.Description + `</div>`);
            $("#CreateDate").html(`<div>` + data.CreateDate + `</div>`);
            $(".catName").html(`<a>` + data.catName + `</a>`);
        });


        function LoadCommentFirstpage() {
            var json_url = "http://localhost/socialnetwork/api/comment/read_paging.php?questionId=" + ID;
            LoadComment(json_url);
        }

        function LoadComment(json_url) {
            $.getJSON(json_url, function(data) {
                var i = 0;
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
            </li>`;
                    myfunction();
                    read_comment_html +=
                        `
                    <button type="button" class="btn btn-link reportbtn" data-toggle="modal" data-target="#exampleModal" value=` +
                        val.ID + ` onclick="myfunction()">Report this answer</button>
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
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                    name="content"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id ="close" class="btn btn-secondary" data-dismiss="modal" onclick ="deletemodel();">Close</button>
                                <button type="submit" class="btn btn-primary">Send report</button>
                            </div>
                            <div id="responsereport"></div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
                `;

                    i = i + 1;
                });
                read_comment_html += ` </ol>`;
                // pagination
                if (data.paging) {
                    read_comment_html += "<ul class='pagination'>";

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
                $(".numberComment").html(i);
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

            $.each(data.records, function(key, val) {
                read_tag_html = `<a href="label.php?labelId=` + val.ID + `" rel="tag">` + val
                    .labelName + `</a>`;
            });
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
                $('#response').html(
                    "<div class='alert alert-danger'>Bạn phải đăng nhập để report cho câu trả lời này!</div>"
                );
            } else {
                var report = createreportForm.serializeObject()
                report.jwt = jwt;

                report.commentId = commentId;
                //report.commentId = $("input[name=reportbtn]").val();
                console.log(report.commentId);
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

    });

    var commentId = $(".reportbtn").val();

    function myfunction() {

        $(document).ready(function() {

            $(".reportbtn").on("click", function() {
                // $(".reportbtn").click(function() {
                commentId = $(this).val();
                console.log(commentId);

            });
            //$(".reportbtn" ).on( "click");
            //$( ".reportbtn" ).trigger( "click" );
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

    //$('.modal-body', '#exampleModal').empty();
    </script>
