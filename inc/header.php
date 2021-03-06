<!doctype html>
        <!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en-US"> <![endif]-->
        <!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
        <!--[if IE 8]>    <html class="lt-ie9" lang="en-US"> <![endif]-->
        <!--[if gt IE 8]><!--> <html lang="en-US"> <!--<![endif]-->

<head>
  <!-- META TAGS -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Social Network</title>
  <link rel="shortcut icon" href="images/favicon.png" />


  <!-- Google Web Fonts-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

  <!-- Style Sheet-->
  <link rel="stylesheet" href="style.css"/>
  <link rel='stylesheet' id='bootstrap-css-css'  href='css/bootstrap.css' type='text/css' media='all' />               
  <link rel='stylesheet' id='responsive-css-css'  href='css/responsive.css?ver=1.0' type='text/css' media='all' />
  <link rel='stylesheet' id='pretty-photo-css-css'  href='js/prettyphoto/prettyPhoto.css?ver=3.1.4' type='text/css' media='all' />
  <link rel='stylesheet' id='main-css-css'  href='css/main.css?ver=1.0' type='text/css' media='all' />
 
                
</head>

<body>  
<div class="header-wrapper">
  <header>
    <div class="container">
      <div class="logo-container">
        <a href="index.php" title="Knowledge Base Theme">
          <img src="images/logo.png" alt="Knowledge Base Theme" />
        </a>
        <span class="tag-line">Social Network</span>
      </div>
      <nav class="main-nav">
        <div class="menu-top-menu-container">
          <ul id="menu-top-menu" class="clearfix">
            <li class="current-menu-item"><a href="index.php">Trang ch???</a></li>
            <li><a href="home-categories-description.php">Danh m???c c??u h???i</a></li>
            <li><a href="home-label-description.php">Tags</a></li>
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
            <li><a href="contact.php">Li??n h???</a></li>
            <?php 
            if($_COOKIE['jwt']==""){
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
                </li>";
              }
            ?>            
          </ul>
        </div>
      </nav>
    </div>
  </header>
</div>
