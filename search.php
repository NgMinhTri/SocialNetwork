<?php include 'inc/header.php';?>
<?php include 'inc/wrapper.php';?>

<!-- Start of Page Container -->
<div class="page-container">
    <div class="container">
        <div class="row">
            <!-- start of page content -->
            <div class="span8 page-content">
                <!-- Basic Home Page Template -->
                <div id='search'>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Container -->

<?php 
$keywords=isset($_GET["keywords"]) ? $_GET["keywords"] : "";
?>

<?php include 'inc/footer.php';?>
<script>
$(document).ready(function() {
    var html = `<ul class="articles">`;
    var keywords = '<?php echo $keywords; ?>';
    // get data from the api based on search keywords
    $.getJSON("api/question/search.php?s=" + keywords, function(data) {
        // template in products.js
        $.each(data.records, function(key, val) {
            html += `<li class="article-entry standard">
                            <h4>
                            <a href="single.php?questionId=` + val.ID + `">` + val.Title + `</a>
                            </h4>
                            <span class="article-meta">` + val.CreateDate + ` in
                                <a href="#" title="View all posts in Server &amp; Database">` + val.catName + `</a></span>
                            
                    </li>`;
        });
        html += `</ul>`;
        $("#search").html(html);
        // inject to 'page-content' of our app
        
        //window.location.replace('search.php');
    });
});
// prevent whole page reload
</script>
