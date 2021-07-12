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


<script>
var html = `<ul class="articles">`;
// var keywords = $('#search-product-form').find(":input[name='keywords']").val();
// console.log(keywords);
var keywords= '<?php echo $keywords; ?>';
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
                                <a href="#" title="View all posts in Server &amp; Database">` + val.category_name + `</a></span>
                            <span class="like-count">` + val.NumberOfVotes + `</span>
                    </li>`;
    });
    html += `</ul>`;

    // inject to 'page-content' of our app
    $("#search").html(html);
    //window.location.replace('search.php');
});

// prevent whole page reload
</script>


<?php include 'inc/footer.php';?>