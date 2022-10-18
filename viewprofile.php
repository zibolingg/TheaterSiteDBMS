<?php
	session_start();
	
	if(!isset($_SESSION['user_id'])){
		header("Location: loginsignup.php");
		exit;
	}

	$user_id = $_SESSION['user_id'];
	$username = $_SESSION['username'];
	$email = $_SESSION['email'];
	$name = "";
	$phone = "";
	$title_movie = "";
	$screen_time = "";
	$id = "";
	$movie_id="";
	$redeem = 1;
	$member = '';
	$customer_id = '';
	$card_name = '';
	$card_address = '';
	$card_number = '';
	$month = '';
	$year = '';
	$cvv = '';


	$db_conn = new mysqli('localhost', 'root', '', 'cinema');

	if (mysqli_connect_errno()) {
		echo 'Connection to database failed:'.mysqli_connect_error();
		exit();
	}

	$query = "select * from customer where
			user_id='".$user_id."'";

	  $result = $db_conn->query($query);
	  if ($result->num_rows == 1)
	  {
		// if they are in the database register the user id
		$row = mysqli_fetch_row($result);
		$customer_id = $row[0];
		$name = $row[2];
		$phone = $row[3];
		$member = $row[4];
	  }

	  if(is_null($name) && is_null($phone)){
		  if(isset($_POST['name']) && isset($_POST['phone']) && strlen($_POST['phone']) >= 7){
			  $forbidden = array('-', ' ', '(', ')');
			  $name = trim($_POST['name']);
			  $phone = str_replace($forbidden, "", trim($_POST['phone']));

			  $query = "update customer set name = '".$name."', phone = '".$phone."' where user_id = $user_id;";
			  $db_conn->query($query);
		  }
	  }
	  
       
		  if(isset($_POST['member'])){
			  $member = $_POST['member'];
			  $query = "update customer set membership = $member where user_id = $user_id;";
			  $db_conn->query($query);
			  $_SESSION['membership'] = 1;
			  
			  
		  
			  
			  if(isset($customer_id) && isset($_POST['card_name']) && isset($_POST['card_address']) && isset($_POST['card_number']) && isset($_POST['month']) && isset($_POST['year']) && isset($_POST['cvv'])){
				  $unsafe = array("-", "/", " ");
				  
				$card_name = filter_var(trim($_POST['card_name']), FILTER_SANITIZE_STRING);
				  
				$card_address =   filter_var(trim($_POST['card_address']), FILTER_SANITIZE_STRING);
				  
				$card_number = filter_var(str_replace($unsafe, "", trim($_POST['card_number'])), FILTER_SANITIZE_STRING);
				  
				$year =   filter_var(trim($_POST['year']), FILTER_SANITIZE_STRING);
				  
				$month =  filter_var(trim($_POST['month']), FILTER_SANITIZE_STRING);
				  
				$cvv =  mysqli_real_escape_string($db_conn,filter_var(trim($_POST['cvv']), FILTER_SANITIZE_STRING));
				  
				$query = "insert into credit_info (customer_id, credit_no, name, billing_address, exp_month, exp_year, security_code) values ($customer_id, $card_number, '".$card_name."', '".$card_address."', $month, $year, $cvv);";
				$db_conn->query($query);
			  
			  }
		 
		  }
			  
		  

	  
	  $query = "select screening_id from reservation where user_id = $user_id and paid =1 and active = 1;";
	  $screenings = $db_conn->query($query);

	 $values =[];
	  $titles_count = 0;
	  while ($row = mysqli_fetch_row($screenings)){
		  ${'screenings'.$titles_count} = $row[0];
		  $values[] = ${'screenings'.$titles_count};
		  $titles_count++;
	  }
		
	$new_count = 0;
	  foreach($values as $id){
		  $query = "select title from movie where movie_id in (select movie_id from screening where screening_id = $id);";
		  
		  $result = $db_conn->query($query);
		  $row = mysqli_fetch_row($result);
		  ${'title'.$new_count} = $row[0];
		  $new_count++;
	  }

	  $new_count = 0;
	  foreach($values as $id){
		  $query = "select screening_time from screening where screening_id = $id;";
		  $result = $db_conn->query($query);
		  $row = mysqli_fetch_row($result);
		  ${'time'.$new_count} = $row[0];
		  $new_count++;
	  }
		 

	  $query = "select total, reservation_id from reservation where user_id = $user_id and paid = 1 and active = 1;";
	  $totals = $db_conn->query($query);

	  
	  $totals_count = 0;
	  while ($row = mysqli_fetch_row($totals)){
		  ${'total'.$totals_count} = $row[0];
		  ${'reservation'.$totals_count} = $row[1];
		  $totals_count++;
	  }

	  $count = count($values);

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
    <title>Profile | Local Movie Theater</title>
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		.card {
		  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		  max-width: 300px;
		  margin: auto;
		  text-align: center;
		}

		.title {
		  color: grey;
		  font-size: 18px;
		}

		button {
		  border: none;
		  outline: 0;
		  display: inline-block;
		  padding: 8px;
		  color: white;
		  background-color: #000;
		  text-align: center;
		  cursor: pointer;
		  width: 100%;
		  font-size: 18px;
		}

		button:hover, a:hover {
		  opacity: 0.7;
		}  
		
		table{
			border-collapse: collapse;
			width: 100%;
		}
		
		td, th {
			border: 1px solid #ddd;
			padding: 8px;
			width = 20%;
			
		}
		
		label { 
			display: block; 
			min-height: 100%;
			height: 100%;
		}
		
		tr:nth-child(even){
			background-color: #f2f2f2;
		}
		
		tr:hover{
			background-color: lightgreen;
		}
		
		th {
			padding-top:12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: black;
			color: white;
		}
	</style>
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
        <section class="module bg-dark-30 about-page-header" data-background="assets/images/auditorium.jpeg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt mb-0">Profile</h1>
              </div>
            </div>
          </div>
        </section>
        <section class="module">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <h4 class="font-alt mb-0">User Profile</h4>
                <hr class="divider-w mt-10 mb-20">
				<form name="redeem" method="post" action="redeem.php">
				
				<?php 
					if($count > 0){
						$master_count = 0;
						  echo "<table><tr>
								<th>Movie</th>
								<th>Screening</th>
								<th>Total</th>
								<th>Status</th>
								<th>Redeem</th>
							  </tr>";
						  while($master_count < $count){
							  echo "<tr><td><label for='${'reservation'.$master_count}'>";
							  echo htmlspecialchars(${'title'.$master_count});
							  echo "</label></td><td><label for='${'reservation'.$master_count}'>";
							  echo htmlspecialchars(${'time'.$master_count});
							  echo "</label></td><td><label for='${'reservation'.$master_count}'> $";
							  echo htmlspecialchars(${'total'.$master_count});
							  echo "</label></td><td><label for='${'reservation'.$master_count}'>PAID</label></td><td><label for='${'reservation'.$master_count}'><input type='radio' id='${'reservation'.$master_count}' name='reservation' value='${'reservation'.$master_count}' required></label></td></tr>";
							  $master_count++;
						  }
						  echo "</table><br>";
					}else{
						  echo "<h5 style='color:red;'>You have no current active reservations to redeem</h5>";
						  $GLOBALS['redeem'] = 0;
					}
				  ?>
				  <button type=submit <?php if($redeem === 0){ echo 'style="display:none;"';} ?> class="btn btn-round btn-b" >Redeem Tickets</button>
				  
				</form>
					
				  <br><br>
            	<div class="card">
					<form action="viewprofile.php" method="post">
						<img src="assets/images/img.jpg" style="width:100%">
						<h1><?php echo htmlspecialchars($username);?></h1>
						<p><?php 
							if(is_null($name)){echo '<input type="text" id="name" class="name" name="name" oninvalid="alert("Please Enter Full Name");" minlength="2" maxlength="60" placeholder="Enter Full Name to Update" required>';}else{echo htmlspecialchars($name);}?></p>
						<p class="title"><?php echo htmlspecialchars($email);?></p>
						<p><?php
							if(is_null($phone)){echo '<input type="tel" id="phone" class="phone" name="phone" oninvalid="alert("Please Enter Phone Number");" minlength="7" maxlength="12" placeholder="Enter Phone Number" required>';}else{echo htmlspecialchars($phone);}?></p>
						<p><?php if(is_null($phone) || is_null($name)){ echo "<button type='submit'>Update Profile</button>";} ?></p>
					</form>
					<br>
				</div>
				  <?php if($_SESSION['membership'] == 0){ ?>
				  <form class="form"  name="creditpurchase" onsubmit="return checkDate()" method="post" action="viewprofile.php" >
					  <br><br>
					  <div class="form-header">
						<h4 class="title">Become A Lifetime Member</h4>
						<h5 > For a One-Time Purchase of $39.99, you get 5% off movie tickets!</h5>
					  </div>
					  <div class="form-body">
						<input type="text" id="name" class="form-control" name="card_name" oninvalid="alert('Please Enter Full Name');" minlength="2" maxlength="60" style="text-transform: none;" placeholder="Enter Full Name As Seen On Card" required>
						<input type="text" id="address" class="form-control"name="card_address" minlength="10" maxlength="2000" oninvalid="alert('Please Enter Full Address Associated With Card');" style="text-transform: none;" placeholder="Enter Complete Billing Address" required>
						<input type="text" class="form-control" id="cardnumber" name="card_number" minlength="13" maxlength="18" style="text-transform: none;" placeholder="Enter (13-18) digit Card Number" oninvalid="alert('Please Enter Full 13-18 digit Card Number');" pattern="[0-9]+" required>
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
						  <br>
						<button type ="submit"  class="btn btn-round btn-b" ><input type="hidden" name="member" value="1">Become A Member</button>
						  
					  </div>

					  </form>
				  <?php } else { echo "";}?>
					
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
                  <p class="copyright font-alt">&copy; 2021&nbsp; Cinema, All Rights Reserved</p>
                <p class="copyright font-alt">&copy; 2017&nbsp;<a href="https://themewagon.com/themes/titan/">Titan</a>, All Rights Reserved</p>
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