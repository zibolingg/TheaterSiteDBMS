<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: loginsignup.php");
		exit;
	}

	if($_SESSION['flag'] == 1 || !isset($_SESSION['flag'])){
		header("Location: nowshowing.php");
		exit;
	}

	$_SESSION['flag'] = 1;
	
	$date = date("Y-m-d");
	$time = date("h:i:s");
	$screening = $_SESSION['screening_id'];
	$user_id = $_SESSION['user_id'];
	$quantity = $_POST['quantity'];
	$seats = $_POST['seats'];
	$deal = '';
	
	$total = htmlspecialchars(number_format(($quantity*9)+($quantity*9*.08),2));
	
	
	if($_SESSION['membership'] == 1){
		$total = htmlspecialchars(number_format(($quantity*9)+($quantity*9*.03),2));
		$deal = htmlspecialchars(number_format(($quantity*9*.05),2));
	}

	$deal_message = "You received your 5% Lifetime Membership discount: $".$deal." off!";

	$_SESSION['whoops'] == 1;

	$db_conn = new mysqli('localhost', 'root', '', 'cinema');

	if (mysqli_connect_errno()) {
		echo 'Connection to database failed:'.mysqli_connect_error();
		exit();
	}

	$number = [];
	$rows = [];
	foreach($seats as $seat){
		$number[] = $seat[0];
		$rows[] = $seat[1];
	}

	$query = "select theater_id from screening where screening_id = $screening;";
	$result = $db_conn->query($query);
	$row = mysqli_fetch_row($result);
	$theater_id = $row[0];

	$seat_ids = [];
	$count = 0;
	foreach($seats as $seat){
		$query = "select seat_id from seat where number = $number[$count] and aisle = '$rows[$count]' and theater_id = $theater_id;";
		$result = $db_conn->query($query);
		$row = mysqli_fetch_row($result);
		$seat_ids[] = $row[0];
		$count++;
	}

	foreach($seat_ids as $id){
		$query = "select count(*) from reserved_seat where screening_id = $screening and seat_id = $id;";
		$result = $db_conn->query($query);
		$row = mysqli_fetch_row($result);
		if($row[0] > 0){
			$db_conn->close();
			$_SESSION['whoops'] = 1;
			header("Location: reservetickets2.php");
			exit;
		}
	}

	$query = "insert into reservation (screening_id, user_id, credit_id, total, paid, active) values ($screening, $user_id, NULL, $total, FALSE, TRUE);";
	$db_conn->query($query);
	
	$query = "select reservation_id from reservation where user_id=$user_id and screening_id=$screening and active = 1 order by reservation_id desc;";
	$result = $db_conn->query($query);
	$row = mysqli_fetch_row($result);
	$reservation_id = $row[0];
	$_SESSION['reservation_id'] = $reservation_id;

	$query = "select theater_id from screening where screening_id = $screening;";
	$result = $db_conn->query($query);
	$row = mysqli_fetch_row($result);
	$theater_id = $row[0];

	$number = [];
	$rows = [];
	foreach($seats as $seat){
		$number[] = $seat[0];
		$rows[] = $seat[1];
	}
	  
	$seat_ids = [];
	$count = 0;
	foreach($seats as $seat){
		$query = "select seat_id from seat where number = $number[$count] and aisle = '$rows[$count]' and theater_id = $theater_id;";
		$result = $db_conn->query($query);
		$row = mysqli_fetch_row($result);
		$seat_ids[] = $row[0];
		$count++;
	}

	foreach($seat_ids as $seat_reserved){
		$query = "insert into reserved_seat (seat_id, reservation_id, screening_id) values ($seat_reserved, $reservation_id, $screening);";
		$db_conn->query($query);
	}

	$query = "select screening_time, movie_id from screening where screening_id = $screening;";
	$result = $db_conn->query($query);
	$row = mysqli_fetch_row($result);
	$screen_time = $row[0];
	$movie_id = $row[1];

	$query = "select title from movie where movie_id = $movie_id;";
	$result = $db_conn->query($query);
	$row = mysqli_fetch_row($result);
	$movie_title = $row[0];
	
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
    <title>Purchase | Local Movie Theater</title>
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
	
	<script>
	  	function checkDate() {
   			var selectedText1 = document.getElementById('month').value;
			var selectedText2 = document.getElementById('year').value;
   			var selectedDate = new Date(selectedText2 + "-" + selectedText1 + "-" + "30");
   			var now = new Date();
		   if (selectedDate < now) {
			alert("Card Expired");
			return false;
		   }
			return true;
 		}
	</script>
	
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
      <div class="main">
        <section class="module">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-sm-12">
                    <h1 class="product-title font-alt">Ticket Checkout</h1>
                  </div>
                </div>
                <div class="row mb-20">
                  <div class="col-sm-12">
                    <div class="price font-alt"><span class="amount">Total (w/ Tax): $<?php echo htmlspecialchars($total);?><br><h4><?php if($deal != ''){echo $deal_message;}?></h4></span></div>
                  </div>
                </div>
                <div class="row mb-20">
                  <div class="col-sm-12">
                    <div class="description">
                      <p>Qty: <?php echo htmlspecialchars($quantity);?></p>
						<p>Seats: <?php foreach($seats as $seat){echo htmlspecialchars($seat." ");}?></p>
						<p>Show: [<?php echo htmlspecialchars($movie_title).' '.htmlspecialchars($screen_time);?>]</p>
						<button class="btn btn-sm btn-block btn-round btn-d" style="
			width: 300px;" type = "button" onclick="window.location.href = 'nowshowing.php';">Cancel Reservation
			    		</button>
						<br>
                    </div>
                  </div>
                </div>
                <div class="row mb-20">	
					<form class="form" name="creditpurchase" onsubmit="return checkDate()" method="post" action="purchaseComplete.php" >
					  <div class="form-header">
						<h4 class="title">Credit card detail</h4>
					  </div>
					  <div class="form-body">
						<input type="text" id="name" class="form-control" name="name" oninvalid="alert('Please Enter Full Name');" minlength="2" maxlength="60" style="text-transform: none;" placeholder="Enter Full Name As Seen On Card" required>
						<input type="text" id="address" class="form-control"name="address" minlength="10" maxlength="2000" oninvalid="alert('Please Enter Full Address Associated With Card');" style="text-transform: none;" placeholder="Enter Complete Billing Address" required>
						<input type="text" class="form-control" id="cardnumber" name="cardnumber" minlength="13" maxlength="19" style="text-transform: none;" placeholder="Enter (13-18) digit Card Number" oninvalid="alert('Please Enter Full 13-18 digit Card Number');" pattern="[0-9]+" required>
						<div >
						  <div class="month">
							<select id = "month" name="month" required>
							  <option value="01">January</option>
							  <option value="02">February</option>
							  <option value="03">March</option>
							  <option value="04">April</option>
							  <option value="05">May</option>
							  <option value="06">June</option>
							  <option value="07">July</option>
							  <option value="08">August</option>
							  <option value="09">September</option>
							  <option value="10">October</option>
							  <option value="11">November</option>
							  <option value="12">December</option>
							</select>
						  </div>
						  <div class="year">
							<select id="year" name="year" required>
							  <?php 
								for ($i = date('Y'); $i <= date('Y')+10; $i++) {
									echo '<option value="'.$i.'">'.$i.'</option>';
								} ?>
							</select>
						  </div>
						</div>
						<div class="card-verification">
						  <div class="cvv-input">
							<input class="form-control" type="text" placeholder="CVV" minlength="2" maxlength="4" name="cvv" pattern="[0-9]+" required>
						  </div>
						  <div class="cvv-details">
							<p>3 or 4 numeric digits found <br> on back of card</p>
						  </div>
						</div>
						<button type="submit" class="btn btn-lg btn-block btn-round btn-d">Purchase</button>
						  
					  </div>
					</form>
                  <div class="col-sm-4 mb-sm-20">
				   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <hr class="divider-w">
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
	<script src="assets/js/creditcardvalidation.js"></script>
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