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
                        <h3>Chủ đề nổi bậc</h3>
                        <div id='search'>
                            <ul class="articles">
                                <li class="article-entry standard">
                                    <h4>
                                        <a href="single.php">Integrating WordPress with Your Website</a>
                                    </h4>
                                    <span class="article-meta">25 Feb, 2013 in
                                        <a href="#" title="View all posts in Server &amp; Database">Server &amp;
                                            Database</a></span>
                                    <span class="like-count">66</span>
                                </li>
                            </ul>
                        </div>
                    </section>

                    <section class="span4 articles-list">
                        <h3>Chủ đề mới nhất</h3>
                        <ul class="articles">
                            <li class="article-entry standard">
                                <h4>
                                    <a href="single.php">Integrating WordPress with Your Website</a>
                                </h4>
                                <span class="article-meta">25 Feb, 2013 in
                                    <a href="#" title="View all posts in Server &amp; Database">Server &amp;
                                        Database</a></span>
                                <span class="like-count">66</span>
                            </li>
                        </ul>
                    </section>
                </div>
            </div>
            <!-- end of page content -->

            <!-- start of sidebar -->
            <aside class="span4 page-sidebar">
                <section class="widget">
                    <div class="support-widget">
                        <h3 class="title">Đặt câu hỏi</h3>

                    </div>
                </section>

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



<!-- <script>
$(document).ready(function() {
    var html = `<ul class="articles">`;
    // when a 'search products' button was clicked
    $(document).on('submit', '#search-product-form', function() {

        // get search keywords
        var keywords = $(this).find(":input[name='keywords']").val();

        // get data from the api based on search keywords
        $.getJSON("http://localhost/SOCIALNETWORK/api/question/search.php?s=" + keywords, function(
        data) {

            // template in products.js
            $.each(data.records, function(key, val) {
                html += `<li class="article-entry standard">
                                <h4>
                                    <a href="single.php">` + val.Title + `</a>
                                </h4>
                                <span class="article-meta">` + val.CreateDate + ` in
                                    <a href="#" title="View all posts in Server &amp; Database">`+ val.category_name +`</a></span>
                                <span class="like-count">` +val.NumberOfVotes+ `</span>
                        </li>`;
            });
            html += `</ul>`;

            // inject to 'page-content' of our app
            $("#search").html(html);
        });

        // prevent whole page reload
        return false;
    });

});
</script> -->
