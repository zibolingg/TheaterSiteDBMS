<?php 
	session_start();
	if(isset($_SESSION['user_id'])){
		header("Location: index.php");
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
    <title>About Us | Local Movie Theater</title>
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
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="index_entry.php">Cinema</a>
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown"><a href="index_entry.php">Home</a>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Movies</a>
                <ul class="dropdown-menu">
                  <li class="dropdown"><a href="nowshowing_nonuser.php" >Now Showing</a>
                  </li>
                  <li class="dropdown"><a href="archive_nonuser.php">Archive</a>
                  </li>
                  </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Our Theater</a>
                <ul class="dropdown-menu">
                  <li class="dropdown"><a href="about_nonuser.php">About Us</a>
                  </li>
                  <li class="dropdown"><a href="events_nonuser.php">Events</a>
                  </li>
                  <li class="dropdown"><a href="contact_nonuser.php">Contact Us</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown"><a href="concessions_nonuser.php">Concessions</a>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Account</a>
                <ul class="dropdown-menu" role="menu">
                  <li class="dropdown"><a href="loginsignup.php">Login</a>
                  </li>
                  <li><a href="loginsignup.php">Sign Up</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="nowshowing_nonuser.php">Reserve Tickets</a>
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
      <div class="main">
        <section class="module bg-dark-60 about-page-header" data-background="assets/images/auditorium.jpeg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">About Us</h2>
                <div class="module-subtitle font-serif">Welcome to Cinema. Come on in, grab a seat, some of our delicious concessions and...action!</div>
              </div>
            </div>
          </div>
        </section>
		<hr class="divider-w">
		<section class="module module-video bg-dark-30" data-background="assets/images/section-12.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <h2 class="module-title font-alt align-left">Our Theaters</h2>
              </div>
            </div>
            <div class="row">
              <div>
                <p class="font-alt">We bring you the latest films and all the excitement! Grab a beer, nachos, popcorn...you name it, it's yours! Our audio and video is unparalleled and we take pride in maintaining safe, comfortable theaters. The reclining seats are outfitted with heat pads and drink coasters...just don't get too comfortable and miss the movie! Strip lights and mood overheads light your way in and out of the theater safely, while our handicap seating and access keep you secure. Please, sit down and enjoy the movie. Welcome to your home away from home.</p>
              </div>
              <div class="col-sm-3">
                <p class="font-serif">You're family here!</p>
              </div>
            </div>
          </div>
          <div class="video-player" data-property="{videoURL:'https://www.youtube.com/watch?v=Uw6jwhjO-xQ', containment:'.module-video', startAt:5, mute:true, autoPlay:true, loop:true, opacity:1, showControls:false, showYTLogo:false, vol:10}"></div>
          <div class="video-controls-box">
            <div class="container">
              <div class="video-controls"><a class="fa fa-volume-up" id="video-volume" href="#">&nbsp;</a><a class="fa fa-pause" id="video-play" href="#">&nbsp;</a></div>
            </div>
          </div>
        </section>
        <section class="module">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <h5 class="font-alt">We’re your local Cinema experts</h5><br/>
                <p>We are proud of our excellent dedicated staff that maintain the highest standard of customer service and a fastidious attention to cleanliness in our theaters. Cinema's management are attentive to your questions and concerns, and are recognized leaders in quality --- providing you with the best possible movie-going experience.</p>
              </div>
              <div class="col-sm-6">
                <img src="assets/images/attendant.jpeg">
              </div>
            </div>
          </div>
        </section>
        <hr class="divider-w">
        <section class="module" id="team">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Meet Our Team</h2>
                <div class="module-subtitle font-serif">Get to know our staff: <br>the friendly faces who make your moviegoing experience that much better!</div>
              </div>
            </div>
            <div class="row">
              <div class="mb-sm-20 wow fadeInUp col-sm-6 col-md-3" onclick="wow fadeInUp">
                <div class="team-item">
                  <div class="team-image"><img src="assets/images/team-1.jpg" alt="Member Photo"/>
                    <div class="team-detail">
                      <h5 class="font-alt">John is THE guy</h5>
                      <p class="font-serif">Have questions? Suggestions? Concerns? John is your guy. He's been with us from the beginning and can help you with any and all of your needs.</p>
                      <div class="team-social"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a></div>
                    </div>
                  </div>
                  <div class="team-descr font-alt">
                    <div class="team-name">John Doe</div>
                    <div class="team-role">Manager</div>
                  </div>
                </div>
              </div>
              <div class="mb-sm-20 wow fadeInUp col-sm-6 col-md-3" onclick="wow fadeInUp">
                <div class="team-item">
                  <div class="team-image"><img src="assets/images/team-3.jpg" alt="Member Photo"/>
                    <div class="team-detail">
                      <h5 class="font-alt">Jane knows cinema</h5>
                      <p class="font-serif">Jane is our resident movie expert/liason. Without her, we wouldn't be here!</p>
                      <div class="team-social"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a></div>
                    </div>
                  </div>
                  <div class="team-descr font-alt">
                    <div class="team-name">Jane Smith</div>
                    <div class="team-role">Assistant Manager</div>
                  </div>
                </div>
              </div>
              <div class="mb-sm-20 wow fadeInUp col-sm-6 col-md-3" onclick="wow fadeInUp">
                <div class="team-item">
                  <div class="team-image"><img src="assets/images/team-4.jpg" alt="Member Photo"/>
                    <div class="team-detail">
                      <h5 class="font-alt">Woo, it's will!</h5>
                      <p class="font-serif">Will joined us back in 2009. He's here to help hook you up with concessions and a great first impression before seeing the film.</p>
                      <div class="team-social"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a></div>
                    </div>
                  </div>
                  <div class="team-descr font-alt">
                    <div class="team-name">Will Waterson</div>
                    <div class="team-role">Cashier</div>
                  </div>
                </div>
              </div>
              <div class="mb-sm-20 wow fadeInUp col-sm-6 col-md-3" onclick="wow fadeInUp">
                <div class="team-item">
                  <div class="team-image"><img src="assets/images/team-3.jpg" alt="Member Photo"/>
                    <div class="team-detail">
                      <h5 class="font-alt">Yes, it's Candy!</h5>
                      <p class="font-serif">She's more than just sweet: she'll show you to your seat! Candy has been with us for a year and is a prime example of a dedicated, hard-working employee. Welcome to the family, Candy!</p>
                      <div class="team-social"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a></div>
                    </div>
                  </div>
                  <div class="team-descr font-alt">
                    <div class="team-name">Candy Edwards</div>
                    <div class="team-role">Attendant</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        
        <div class="module-small bg-dark">
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
                    <li><a href="index_entry.php">Home</a></li>
                    <li><a href="nowshowing_nonuser.php">Now Showing</a></li>
                    <li><a href="archive_nonuser.php">Archive</a></li>
                    <li><a href="about_nonuser.php">About Us</a></li>
                    <li><a href="events_nonuser.php">Events</a></li>
                    <li><a href="contact_nonuser.php">Contact Us</a></li>
                    <li><a href="concessions_nonuser.php">Concessions</a></li>
                    <li><a href="loginsignup.php">Login/Sign Up</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr class="divider-d">
        <footer class="footer bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                  <p class="copyright font-alt">&copy; 2021&nbsp;<a href="index_entry.php">Cinema</a>, All Rights Reserved</p>
                <p class="copyright font-alt">&copy; 2017&nbsp;<a href="index_entry.php">TitaN</a>, All Rights Reserved</p>
              </div>
              <div class="col-sm-6">
                <div class="footer-social-links"><a href="http://www.facebook.com"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a>
                </div>
              </div>
            </div>
          </div>
        </footer>
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