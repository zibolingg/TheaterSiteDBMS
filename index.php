<?php 
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: loginsignup.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--  
    Document Title
    =============================================
    -->
    <title>Home | Local Movie Theater</title>
    <!--  
    Favicons
    =============================================
    -->
    <link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicons/faviconcinema.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/images/favicons/faviconcinema.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicons/faviconcinema.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicons/faviconcinema.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicons/faviconcinema.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicons/faviconcinema.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicons/faviconcinema.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicons/faviconcinema.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/faviconcinema.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/images/favicons/faviconcinema.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/faviconcinema.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicons/faviconcinema.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/faviconcinema.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/images/favicons/faviconcinema.png">
    <meta name="theme-color" content="#ffffff">
    <!--  
    Stylesheets
    =============================================
    
    -->
    <!-- Default stylesheets-->
    <link href="assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template specific stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="assets/lib/animate.css/animate.css" rel="stylesheet">
    <link href="assets/lib/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/lib/et-line-font/et-line-font.css" rel="stylesheet">
    <link href="assets/lib/flexslider/flexslider.css" rel="stylesheet">
    <link href="assets/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="assets/lib/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
    <link href="assets/lib/simple-text-rotator/simpletextrotator.css" rel="stylesheet">
    <!-- Main stylesheet and color file-->
    <link href="assets/css/style.css" rel="stylesheet">
    <link id="color-scheme" href="assets/css/colors/default.css" rel="stylesheet">
  </head>
  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>
      <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="index.php">Cinema</a>
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown"><a href="index.php">Home</a>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Movies</a>
                <ul class="dropdown-menu">
                  <li class="dropdown"><a href="nowshowing.php" >Now Showing</a>
                  </li>
                  <li class="dropdown"><a href="archive.php">Archive</a>
                  </li>
                  </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Our Theater</a>
                <ul class="dropdown-menu">
                  <li class="dropdown"><a href="about.php">About Us</a>
                  </li>
                  <li class="dropdown"><a href="events.php">Events</a>
                  </li>
                  <li class="dropdown"><a href="contact.php">Contact Us</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown"><a href="concessions.php">Concessions</a>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Account</a>
                <ul class="dropdown-menu" role="menu">
				  <li><a href="viewprofile.php">Profile</a></li>
                  <li><a href="logout.php">Logout</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="nowshowing.php">Reserve Tickets</a>
              </li>
              <!--li.dropdown.navbar-cart-->
              <!--    a.dropdown-toggle(href='#', data-toggle='dropdown')-->
              <!--        span.icon-basket-->
              <!--        |-->
              <!--        span.cart-item-number 2-->
              <!--    ul.dropdown-menu.cart-list(role='menu')-->
              <!--        li-->
              <!--            .navbar-cart-item.clearfix-->
              <!--                .navbar-cart-img-->
              <!--                    a(href='#')-->
              <!--                        img(src='assets/images/shop/product-9.jpg', alt='')-->
              <!--                .navbar-cart-title-->
              <!--                    a(href='#') Short striped sweater-->
              <!--                    |-->
              <!--                    span.cart-amount 2 &times; $119.00-->
              <!--                    br-->
              <!--                    |-->
              <!--                    strong.cart-amount $238.00-->
              <!--        li-->
              <!--            .navbar-cart-item.clearfix-->
              <!--                .navbar-cart-img-->
              <!--                    a(href='#')-->
              <!--                        img(src='assets/images/shop/product-10.jpg', alt='')-->
              <!--                .navbar-cart-title-->
              <!--                    a(href='#') Colored jewel rings-->
              <!--                    |-->
              <!--                    span.cart-amount 2 &times; $119.00-->
              <!--                    br-->
              <!--                    |-->
              <!--                    strong.cart-amount $238.00-->
              <!--        li-->
              <!--            .clearfix-->
              <!--                .cart-sub-totle-->
              <!--                    strong Total: $476.00-->
              <!--        li-->
              <!--            .clearfix-->
              <!--                a.btn.btn-block.btn-round.btn-font-w(type='submit') Checkout-->
              <!--li.dropdown-->
              <!--    a.dropdown-toggle(href='#', data-toggle='dropdown') Search-->
              <!--    ul.dropdown-menu(role='menu')-->
              <!--        li-->
              <!--            .dropdown-search-->
              <!--                form(role='form')-->
              <!--                    input.form-control(type='text', placeholder='Search...')-->
              <!--                    |-->
              <!--                    button.search-btn(type='submit')-->
              <!--                        i.fa.fa-search-->
            </ul>
          </div>
        </div>
      </nav>
      <section class="bg-dark-30 showcase-page-header module parallax-bg" data-background="assets/images/auditorium.jpeg">
        <div class="titan-caption">
          <div class="caption-content">
            <div class="font-alt mb-30 titan-title-size-1">Welcome to your</div>
            <div class="font-alt mb-40 titan-title-size-4">Local Theater</div><a class="section-scroll btn btn-border-w btn-round" href="nowshowing.php">Reserve Tickets</a>
          </div>
        </div>
      </section>
      <div class="main showcase-page">
        <section class="module-extra-small bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-md-8 col-lg-9">
                <div class="callout-text font-alt">
                  <h4 style="margin-top: 0px; font-;">Grab a seat and enjoy the show</h4>
                  <p style="margin-bottom: 0px;">Make Your Reservation today!</p><p>Or Partake of our online content and Archive of past features</p>
				  <?php
					if(isset($_SESSION['valid_user'])){
						echo '<p style=margin-bottom: 0px;">You are logged in as: '.$_SESSION['valid_user'].' <br />';
						echo '<a href="logout.php">Logout</a></p>';
					}else{
						header("Location: loginsignup.php");
					}
				  ?>
                </div>
              </div>
      
            </div>
          </div>
        </section>
        <section class="module">
			<div class="container">
				<div class="row" style="text-align: center;"><h3>Hours of Operation:</h3><br><h4>Monday	11AM to 10PM</h4>
			<h4>Tuesday	11AM to 10PM</h4>
			<h4>Wednesday	11AM to 10PM</h4>
			<h4>Thursday	11AM to 10PM</h4>
			<h4>Friday	11AM to 10PM</h4>
			<h4>Saturday	11AM to 10PM</h4>
			<h4>Sunday	11AM to 10PM</h4>
			<p></p>
			<p><i>*Closures Announced Here and the Events Page*</i></p>
			</div>
			</div>
		  </section>
        <section class="module-extra-small bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt">About Cinema</h5>
                  <p>Just your local cinema. Welcome!</p>
                  <p>Phone: +1 234 567 89 10</p>
                  <p>Fax: +1 234 567 89 10</p>
                  <p>Email: <a href="#">cinema@example.com</a></p>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt">Site Navigation</h5>
                  <ul class="icon-list">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="nowshowing.php">Now Showing</a></li>
                    <li><a href="archive.php">Archive</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="concessions.php">Concessions</a></li>
					<li><a href="viewprofile.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
        <footer class="footer bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                  <p class="copyright font-alt">&copy; 2021&nbsp;<a href="index.html">Cinema</a>, All Rights Reserved</p>
                <p class="copyright font-alt">&copy; 2017&nbsp;<a href="index.html">TitaN</a>, All Rights Reserved</p>
              </div>
              <div class="col-sm-6">
                <div class="footer-social-links"><a href="http://www.facebook.com"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a>
                </div>
              </div>
            </div>
          </div>
        </footer>
          </div>
        </section>
      </div>
      <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
    </main>
    <!--  
    JavaScripts
    =============================================
    -->
    <script src="assets/lib/jquery/dist/jquery.js"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/lib/wow/dist/wow.js"></script>
    <script src="assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
    <script src="assets/lib/isotope/dist/isotope.pkgd.js"></script>
    <script src="assets/lib/imagesloaded/imagesloaded.pkgd.js"></script>
    <script src="assets/lib/flexslider/jquery.flexslider.js"></script>
    <script src="assets/lib/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="assets/lib/smoothscroll.js"></script>
    <script src="assets/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
    <script src="assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>