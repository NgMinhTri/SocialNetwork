<!-- Start of Footer -->
<footer id="footer-wrapper">
      <div id="footer" class="container">
        <div class="row">
          <div class="span3">
            <section class="widget">
              <h3 class="title">Social Network</h3>
              <div class="textwidget">
                <p>
                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
                  diam nonummy nibh euismod tincidunt ut laoreet dolore magna
                  aliquam erat volutpat.
                </p>
                <p>
                  Ut wisi enim ad minim veniam, quis nostrud exerci tation
                  ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo
                  consequat.
                </p>
              </div>
            </section>
          </div>
          <div class="span3">
            <section class="widget">
              <h3 class="title">Về Website</h3>
              <ul>
                <li>
                  <a href="index.php" title="Lorem ipsum dolor sit amet,"
                    >Home</a
                  >
                </li>
                <li>
                  <a href="ask.php" title="Lorem ipsum dolor sit amet,"
                    >Tạo câu hỏi</a
                  >
                </li>
                <li>
                  <a href="home-categories-description.php.php" title="Lorem ipsum dolor sit amet,"
                    >Danh mục</a
                  >
                </li>
                <li>
                  <a href="home-label-description.php" title="Lorem ipsum dolor sit amet,"
                    >Tag</a
                  >
                </li>
                <li>
                  <a href="profile.php" title="Lorem ipsum dolor sit amet, "
                    >Profile</a
                  >
                </li>
                <li>
                  <a href="history.php" title="Lorem ipsum dolor sit amet,"
                    >History</a
                  >
                </li>
                
              </ul>
            </section>
          </div>
          <div class="span3">
            <section class="widget">
              <h3 class="title">Tweet mới nhất</h3>
              <div id="twitter_update_list">
                <ul>
                  <li>No Tweets loaded !</li>
                </ul>
              </div>
              <script
                src="http://twitterjs.googlecode.com/svn/trunk/src/twitter.min.js"
                type="text/javascript"
              ></script>
              <script type="text/javascript">
                getTwitters("twitter_update_list", {
                  id: "960development",
                  count: 3,
                  enableLinks: true,
                  ignoreReplies: true,
                  clearContents: true,
                  template: "%text% <span>%time%</span>",
                });
              </script>
            </section>
          </div>
          <div class="span3">
            <section class="widget">
              <h3 class="title">Flickr Photos</h3>
              <div class="flickr-photos" id="basicuse"></div>
            </section>
          </div>
        </div>
      </div>
      <!-- end of #footer -->
      <!-- Footer Bottom -->
      <div id="footer-bottom-wrapper">
        <div id="footer-bottom" class="container">
          <div class="row">
            <div class="span6">
              <p class="copyright">
                Copyright © 2021. All Rights Reserved by UDPT-10.
              </p>
            </div>
            <div class="span6">
              <!-- Social Navigation -->
              <ul class="social-nav clearfix">
                <li class="linkedin"><a target="_blank" href="#"></a></li>
                <li class="stumble"><a target="_blank" href="#"></a></li>
                <li class="google"><a target="_blank" href="#"></a></li>
                <li class="deviantart"><a target="_blank" href="#"></a></li>
                <li class="flickr"><a target="_blank" href="#"></a></li>
                <li class="skype">
                  <a target="_blank" href="skype:#?call"></a>
                </li>
                <li class="rss"><a target="_blank" href="#"></a></li>
                <li class="twitter"><a target="_blank" href="#"></a></li>
                <li class="facebook"><a target="_blank" href="https://www.facebook.com/groups/485795942772826"></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- End of Footer Bottom -->
    </footer>
    <!-- End of Footer -->
    <a href="#top" id="scroll-top"></a>
    <!-- script -->
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script
      type="text/javascript"
      src="js/prettyphoto/jquery.prettyPhoto.js"
    ></script>
    <script type="text/javascript" src="js/jflickrfeed.js"></script>
    <script type="text/javascript" src="js/jquery.liveSearch.js"></script>
    <script type="text/javascript" src="js/jquery.form.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/jquery-twitterFetcher.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  </body>
</html>