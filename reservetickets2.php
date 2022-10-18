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

	$_SESSION['flag'] == 0;

	$screening = '';
	if(isset($_SESSION['screening_id'])){
		$screening = $_SESSION['screening_id'];
	}
	else{
		$screening = $_POST['movie_time'];
		$_SESSION['screening_id'] = $screening;
	}

	$failed_selection = "";
	if(isset($_SESSION['whoops']) && ($_SESSION['whoops'] == 1)){
		$_SESSION['whoops'] == 0;
		$failed_selection = "Whoops! Looks like someone just reserved those seats. Please select from available seats.";
	}

	$user_id = $_SESSION['user_id'];

	$date = date("Y-m-d");
	$time = date("h:i:s");

	$db_conn = new mysqli('localhost', 'root', '', 'cinema');

	if (mysqli_connect_errno()) {
		echo 'Connection to database failed:'.mysqli_connect_error();
		exit();
	}

	

	$query = "select title, movie_id from movie where movie_id in (select movie_id from screening where screening_id = $screening);";
	$result = $db_conn->query($query);
	$row = mysqli_fetch_row($result);
	$movie = $row[0];
	$movie_id = $row[1];

	$query = "select screening_time, theater_id from screening where screening_id = $screening;";
	$result = $db_conn->query($query);
	$row = mysqli_fetch_row($result);
	$movie_time = $row[0];
	$theater_id = $row[1];



	$query = "select * from seat where theater_id = $theater_id;";
	$result = $db_conn->query($query);
	$seat_rows = [];
	while($row = mysqli_fetch_array($result))
	{
		$seat_rows[] = $row;
	}

	$query = "select * from seat where seat_id in (select seat_id from reserved_seat where screening_id = $screening);";
	$result = $db_conn->query($query);
	$taken_rows = [];
	while($row2 = mysqli_fetch_array($result))
	{
		$taken_rows[] = $row2;
	}

	$class_message = [];
	$seat_id = [];
	foreach($seat_rows as $id) {
		$seat_id[] = $id[0];
	}
	$taken_id = [];
	foreach($taken_rows as $id2) {
		$taken_id[] = $id2[0];
	}
	$count = 0;
	foreach($seat_rows as $array1){
		foreach($taken_rows as $array2){
			if($array1 == $array2){
				$class_message[] = "seat sold";
			}
		}
		if($class_message[$count] != "seat sold"){
			$class_message[] = "seat";
		}
		$count++;
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
    <title>Reserve Tickets | Local Movie Theater</title>
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
	<link href="assets/css/styleseats.css" rel="stylesheet">
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
      <div class="main">
        <section class="module" >
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt">Seat Reservation Checkout</h1>
              </div>
            </div>
            <hr class="divider-w pt-20">
            <div class="row">
              <div class="col-sm-12">
                <form onsubmit="myFunction()" id="my-form" action="purchase.php" method="post">
				<div class="movie-container">
				  <label> Movie Times:<?php echo ' '.htmlspecialchars($movie).' ('.htmlspecialchars($movie_time).')';?></label>
				  <select id="movie" name="price" style="display: none;">
					  <option value="9" selected="selected"></option>
				  </select>
				<p><?php echo htmlspecialchars($failed_selection);?></p>
				</div>
				<ul class="showcase">
				  <li>
					<div class="seat"></div>
					<small>Available</small>
				  </li>
				  <li>
					<div class="seat selected"></div>
					<small>Selected</small>
				  </li>
				  <li>
					<div class="seat sold"></div>
					<small>Sold</small>
				  </li>
				</ul>
				<div class="cuntainer">
				  <div class="screen"></div>
				  <div class="theaterrow" id="a">
					
					<label for="1A"><div class="<?php echo htmlspecialchars($class_message[0]); ?>" id="1a"><input type="checkbox" id="1A" value="1A" <?php if($class_message[0] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="2A"><div class="<?php echo htmlspecialchars($class_message[1]); ?>" id="2a"><input type="checkbox" id="2A" value="2A" <?php if($class_message[1] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="3A"><div class="<?php echo htmlspecialchars($class_message[2]); ?>" id="3a"><input type="checkbox" id="3A" value="3A" <?php if($class_message[2] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="4A"><div class="<?php echo htmlspecialchars($class_message[3]); ?>" id="4a"><input type="checkbox" id="4A" value="4A" <?php if($class_message[3] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="5A"><div class="<?php echo htmlspecialchars($class_message[4]); ?>" id="5a"><input type="checkbox" id="5A" value="5A" <?php if($class_message[4] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="6A"><div class="<?php echo htmlspecialchars($class_message[5]); ?>" id="6a"><input type="checkbox" id="6A" value="6A" <?php if($class_message[5] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="7A"><div class="<?php echo htmlspecialchars($class_message[6]); ?>" id="7a"><input type="checkbox" id="7A" value="7A" <?php if($class_message[6] == "seat"){echo 'name="seats[]"';}?>  style="display: none;"></div></label>
					<label for="8A"><div class="<?php echo htmlspecialchars($class_message[7]); ?>" id="8a"><input type="checkbox" id="8A" value="8A" <?php if($class_message[7] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
				  </div>

				  <div class="theaterrow" id="b">
					<label for="1B"><div class="<?php echo htmlspecialchars($class_message[8]); ?>" id="1b"><input type="checkbox" id="1B" value="1B" <?php if($class_message[8] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="2B"><div class="<?php echo htmlspecialchars($class_message[9]); ?>" id="2b"><input type="checkbox" id="2B" value="2B" <?php if($class_message[9] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="3B"><div class="<?php echo htmlspecialchars($class_message[10]); ?>" id="3b"><input type="checkbox" id="3B" value="3B" <?php if($class_message[10] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="4B"><div class="<?php echo htmlspecialchars($class_message[11]); ?>" id="4b"><input type="checkbox" id="4B" value="4B" <?php if($class_message[11] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="5B"><div class="<?php echo htmlspecialchars($class_message[12]); ?>" id="5b"><input type="checkbox" id="5B" value="5B" <?php if($class_message[12] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="6B"><div class="<?php echo htmlspecialchars($class_message[13]); ?>" id="6b"><input type="checkbox" id="6B" value="6B" <?php if($class_message[13] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="7B"><div class="<?php echo htmlspecialchars($class_message[14]); ?>" id="7b"><input type="checkbox" id="7B" value="7B" <?php if($class_message[14] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="8B"><div class="<?php echo htmlspecialchars($class_message[15]); ?>" id="8b"><input type="checkbox" id="8B" value="8B" <?php if($class_message[15] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
				  </div>
				  <div class="theaterrow" id="c">
					<label for="1C"><div class="<?php echo htmlspecialchars($class_message[16]); ?>" id="1c"><input type="checkbox" id="1C" value="1C" <?php if($class_message[16] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="2C"><div class="<?php echo htmlspecialchars($class_message[17]); ?>" id="2c"><input type="checkbox" id="2C" value="2C" <?php if($class_message[17] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="3C"><div class="<?php echo htmlspecialchars($class_message[18]); ?>" id="3c"><input type="checkbox" id="3C" value="3C" <?php if($class_message[18] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="4C"><div class="<?php echo htmlspecialchars($class_message[19]); ?>" id="4c"><input type="checkbox" id="4C" value="4C" <?php if($class_message[19] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="5C"><div class="<?php echo htmlspecialchars($class_message[20]); ?>" id="5c"><input type="checkbox" id="5C" value="5C" <?php if($class_message[20] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="6C"><div class="<?php echo htmlspecialchars($class_message[21]); ?>" id="6c"><input type="checkbox" id="6C" value="6C" <?php if($class_message[21] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="7C"><div class="<?php echo htmlspecialchars($class_message[22]); ?>" id="7c"><input type="checkbox" id="7C" value="7C" <?php if($class_message[22] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="8C"><div class="<?php echo htmlspecialchars($class_message[23]); ?>" id="8c"><input type="checkbox" id="8C" value="8C" <?php if($class_message[23] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
				  </div>
				  <div class="theaterrow" id="d">
					<label for="1D"><div class="<?php echo htmlspecialchars($class_message[24]); ?>" id="1d"><input type="checkbox" id="1D" value="1D" <?php if($class_message[24] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="2D"><div class="<?php echo htmlspecialchars($class_message[25]); ?>" id="2d"><input type="checkbox" id="2D" value="2D" <?php if($class_message[25] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="3D"><div class="<?php echo htmlspecialchars($class_message[26]); ?>" id="3d"><input type="checkbox" id="3D" value="3D" <?php if($class_message[26] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="4D"><div class="<?php echo htmlspecialchars($class_message[27]); ?>" id="4d"><input type="checkbox" id="4D" value="4D" <?php if($class_message[27] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="5D"><div class="<?php echo htmlspecialchars($class_message[28]); ?>" id="5d"><input type="checkbox" id="5D" value="5D" <?php if($class_message[28] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="6D"><div class="<?php echo htmlspecialchars($class_message[29]); ?>" id="6d"><input type="checkbox" id="6D" value="6D" <?php if($class_message[29] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="7D"><div class="<?php echo htmlspecialchars($class_message[30]); ?>" id="7d"><input type="checkbox" id="7D" value="7D" <?php if($class_message[30] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="8D"><div class="<?php echo htmlspecialchars($class_message[31]); ?>" id="8d"><input type="checkbox" id="8D" value="8D" <?php if($class_message[31] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
				  </div>
				  <div class="theaterrow" id="e">
					<label for="1E"><div class="<?php echo htmlspecialchars($class_message[32]); ?>" id="1e"><input type="checkbox" id="1E" value="1E" <?php if($class_message[32] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="2E"><div class="<?php echo htmlspecialchars($class_message[33]); ?>" id="2e"><input type="checkbox" id="2E" value="2E" <?php if($class_message[33] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="3E"><div class="<?php echo htmlspecialchars($class_message[34]); ?>" id="3e"><input type="checkbox" id="3E" value="3E" <?php if($class_message[34] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="4E"><div class="<?php echo htmlspecialchars($class_message[35]); ?>" id="4e"><input type="checkbox" id="4E" value="4E" <?php if($class_message[35] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="5E"><div class="<?php echo htmlspecialchars($class_message[36]); ?>" id="5e"><input type="checkbox" id="5E" value="5E" <?php if($class_message[36] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="6E"><div class="<?php echo htmlspecialchars($class_message[37]); ?>" id="6e"><input type="checkbox" id="6E" value="6E" <?php if($class_message[37] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="7E"><div class="<?php echo htmlspecialchars($class_message[38]); ?>" id="7e"><input type="checkbox" id="7E" value="7E" <?php if($class_message[38] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="8E"><div class="<?php echo htmlspecialchars($class_message[39]); ?>" id="8e"><input type="checkbox" id="8E" value="8E" <?php if($class_message[39] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
				  </div>
				  <div class="theaterrow" id="f">
					<label for="1F"><div class="<?php echo htmlspecialchars($class_message[40]); ?>" id="1f"><input type="checkbox" id="1F" value="1F" <?php if($class_message[40] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="2F"><div class="<?php echo htmlspecialchars($class_message[41]); ?>" id="2f"><input type="checkbox" id="2F" value="2F" <?php if($class_message[41] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="3F"><div class="<?php echo htmlspecialchars($class_message[42]); ?>" id="3f"><input type="checkbox" id="3F" value="3F" <?php if($class_message[42] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="4F"><div class="<?php echo htmlspecialchars($class_message[43]); ?>" id="4f"><input type="checkbox" id="4F" value="4F" <?php if($class_message[43] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="5F"><div class="<?php echo htmlspecialchars($class_message[44]); ?>" id="5f"><input type="checkbox" id="5F" value="5F" <?php if($class_message[44] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="6F"><div class="<?php echo htmlspecialchars($class_message[45]); ?>" id="6f"><input type="checkbox" id="6F" value="6F" <?php if($class_message[45] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="7F"><div class="<?php echo htmlspecialchars($class_message[46]); ?>" id="7f"><input type="checkbox" id="7F" value="7F" <?php if($class_message[46] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
					<label for="8F"><div class="<?php echo htmlspecialchars($class_message[47]); ?>" id="8f"><input type="checkbox" id="8F" value="8F" <?php if($class_message[47] == "seat"){echo 'name="seats[]"';}?> style="display: none;"></div></label>
				  </div>
			<div class="shop-Cart-totalbox">	  
              </div>
            	</div>
            		<div class="row">
            			</div>
						<hr class="divider-w">
						<div class="row mt-70">
						  <div class="col-sm-5 col-sm-offset-7">
							<div class="shop-Cart-totalbox">
							  <h4 class="font-alt">Totals</h4>
								
							  <table class="table table-striped table-border checkout-table">
								<tbody>
								  <tr>
									<th>Seats (Qty):</th>
									<td>
										<span class="quantityspan" id="count"></span>
										<input type="hidden" name="quantity" id="quantity" value="not yet defined" required>
									</td>
								  </tr>
								  <tr class="shop-Cart-totalprice">
									<th>Subtotal :</th>
									<td>$<span id="total" name="total"></span></td>
								  </tr>
								</tbody>
							  </table>
								
							  		<button class="btn btn-lg btn-block btn-round btn-d" type="submit" onclick="return checkSubmission();">Proceed to Checkout
									</button>
									<button class="btn btn-lg btn-block btn-round btn-d" type = "button" onclick="window.location.href = 'reservetickets.php';">Back
									</button>
								
								</div>
							</div>
				  		</div>
				  </form>
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
	<script src="assets/js/quantity.js"></script>
	<script src="assets/js/seating.js"></script>
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