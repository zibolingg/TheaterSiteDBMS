<?php 
session_start();
	if(isset($_SESSION['user_id'])){
		header("Location: index.php");
		exit;
	} 
	
	$date = date("Y-m-d");
	$time = date("h:i:s");

	function splitAtIndex($string, $index){
		$arr     = array();
		$arrStrings     = preg_split("#,\s?#", $string);
		if(!empty($arrStrings)){
			$partB          = array_splice($arrStrings, $index);
			$partA          = $arrStrings;
			$arr[]   = implode(", ", $partA) . ", ";
			$arr[]   = implode(", ", $partB);
		}
		return $arr;
	}

	$error = "";

	$type=$_POST['type'];
    $search=trim($_POST['search']);

    if (!$type || is_null($search)) {
       $error = 'You have not entered proper search details.
       Please go back and try again.';
    } else {


	$db_conn = new mysqli('localhost', 'root', '', 'cinema');

	if (mysqli_connect_errno()) {
	echo 'Connection to database failed:'.mysqli_connect_error();
	exit();
	}

	$query = "select title from movie where $type like '%".$search."%';";
	$movie_titles = $db_conn->query($query);

	$query = "select director from movie where $type like '%".$search."%';";
	$movie_directors = $db_conn->query($query);

	$query = "select release_date from movie where $type like '%".$search."%';";
	$movie_release_dates = $db_conn->query($query);

	$query = "select trailer from movie where $type like '%".$search."%';";
	$movie_trailers = $db_conn->query($query);

	$query = "select cast from movie where $type like '%".$search."%';";
	$movie_cast = $db_conn->query($query);

	$query = "select description from movie where $type like '%".$search."%';";
	$movie_description = $db_conn->query($query);


	$title_count = 0;
	while ($row = mysqli_fetch_row($movie_titles)){
		${'title'.$title_count} = $row[0];
		$title_count++;
	}
	if(empty($title0)){
		$error = "This search did not match any results. Please try again.";
	}

	$director_count = 0;
	while ($row = mysqli_fetch_row($movie_directors)){
		${'director'.$director_count} = $row[0];
		$director_count++;
	}

	$release_count = 0;
	while ($row = mysqli_fetch_row($movie_release_dates)){
		${'release'.$release_count} = $row[0];
		$release_count++;
	}

	$trailer_count = 0;
	while ($row = mysqli_fetch_row($movie_trailers)){
		${'trailer'.$trailer_count} = $row[0];
		$trailer_count++;
	}

	$cast_count = 0;
	while ($row = mysqli_fetch_row($movie_cast)){
		${'cast'.$cast_count} = $row[0];
		$cast_count++;
	}

	$desc_count = 0;
	while ($row = mysqli_fetch_row($movie_description)){
		${'description'.$desc_count} = $row[0];
		$desc_count++;
	}

	}


	$db_conn->close();

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
    <title>Search | Local Movie Theater</title>
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
	<link  href="assets/css/popup.css" rel="stylesheet">
  </head>
  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>
      <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="index_entry.php" >Cinema</a>
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
        <section class="module bg-dark-60 blog-page-header" data-background="assets/images/archive.jpeg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Archive</h2>
                <div class="module-subtitle font-serif">Search Our Previous Releases:<br> A Section For Cinephiles</div>
              </div>
            </div>
          </div>
        </section>
        <section class="module">
          <div class="container">
			  <form id="form" method="post" action="searchresults_nonuser.php" style="justify-content: center;">
			  <label>Choose search category:
			  <select name="type" required>
				  <option value="title">Title</option>
				  <option value="director">Director</option>
				  <option value="cast">Cast</option>
				  <option value="genre">Genre</option>
				  <option value="release_date">Year Released</option>
		      </select>
			  </label>
  			  <input type="search" id="query" name="search" placeholder="Search..." minlength="1" maxlength="50" pattern="^(?=.*\S).+$" required>
  			  <button type="submit">Search</button>
			  </form><br>
			  
            <div class="row multi-columns-row post-columns">
				<?php
				if($error == ""){
				$master_count = 0;
				while($master_count < $GLOBALS['trailer_count']){
					$arr = splitAtIndex(${'cast'.$master_count}, 2);
					$string = $arr[0];
              		echo '<div class="col-sm-6 col-md-4 col-lg-4">';
					echo '<div class="post">';
					echo'<div class="post-thumbnail" ><a href="#"><iframe  src="';
					echo htmlspecialchars(${'trailer'.$master_count});
					echo'"></iframe></a></div>';
                  	echo '<div class="post-header font-alt">';
                    echo'<h2 class="post-title"><a href="#">'; 
					echo htmlspecialchars(${'title'.$master_count});
					echo'</a></h2>';
                    echo '<div class="post-meta">By&nbsp;<a href="#">';
					echo htmlspecialchars(${'director'.$master_count});
					echo '</a>&nbsp;| ';
					echo htmlspecialchars(rtrim($string, ", "));
					echo ' | Released '; 
					echo htmlspecialchars(${'release'.$master_count});
                    echo '</div>';
                  	echo '</div>';
                  	echo '<div class="post-entry" style="font-size: 10px">';	
                    echo ' <div class="popup" onclick="myFunction(\'myPopup'.$master_count.'\')">Click Here For Description
  					<span class="popuptext" id="myPopup'.$master_count.'">';
					echo htmlspecialchars(${'description'.$master_count});
					echo '</span>
                  </div>';
                  	echo '</div>';
                  	echo '</div></div>';
					$master_count++;
				}
				} else{
					echo '<h2>'.htmlspecialchars($error).'<h2>';
				}
	  		 ?>
              
            </div>
			  <p style="font-size: 16px"><a class="more-link" href="archive_nonuser.php">Back to Archive</a></p>
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
                    <li><a href="loginsignup.php">Logout</a></li>
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
      <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
    </main>
    <!--  
    JavaScripts
    =============================================
    -->
	<script src="assets/js/popupdescription.js">
	</script>
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