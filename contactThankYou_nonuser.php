<?php 
	session_start();
	if(isset($_SESSION['user_id'])){
		header("Location: index.php");
		exit;
	}

	$db_conn = new mysqli('localhost', 'root', '', 'cinema');

	if (mysqli_connect_errno()) {
	echo 'Connection to database failed:'.mysqli_connect_error();
	exit();
	}

	$query = "select email from user limit 1;";

	$result = $db_conn->query($query);
	$row = mysqli_fetch_row($result);
	$admin_email = $row[0];
	$admin_pass = substr($row[0], 0, 17);
	
	
	$message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);
	$subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
	$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);

	$db_conn->close();
	
	if(!$email){
		$_SESSION['error'] = 1;
		header("Location: contact_nonuser.php");
		exit;
	}

	if(!$subject){
		$_SESSION['error'] = 2;
		header("Location: contact_nonuser.php");
		exit;
	}

	if(!$message){
		$_SESSION['error'] = 3;
		header("Location: contact_nonuser.php");
		exit;
	}

	$response = "";

	require_once('SMTP.php');
	require_once('PHPMailer.php');
	require_once('Exception.php');

	use \PHPMailer\PHPMailer\PHPMailer;
	use \PHPMailer\PHPMailer\Exception;

	$mail=new PHPMailer(true); // Passing `true` enables exceptions

	try {
		//settings
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host='smtp.gmail.com';
		$mail->SMTPAuth=true; // Enable SMTP authentication
		$mail->Username=$admin_email; // SMTP username
		$mail->Password=$admin_pass; // SMTP password
		$mail->SMTPSecure='ssl';
		$mail->Port=465;

		$mail->ClearReplyTos();
		$mail->addReplyTo($email, $email);
		$mail->setFrom($email, $email);

		//recipient
		$mail->addAddress($admin_email, 'Administrator');     // Add a recipient

		//content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject=$subject;
		$mail->Body=$message;
		$mail->AltBody=$message;

		$mail->send();

		$response = "Message has been sent.\nThank you for reaching out to us!\nWe will reply as soon as possible.";
	} 
	catch(Exception $e) {
		$response = "Message could not be sent.";
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
    <title>Contact Confirmation | Local Movie Theater</title>
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
        <section class="module bg-dark-30 about-page-header" data-background="assets/images/auditorium.jpeg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt mb-0">Contact Us</h1>
              </div>
            </div>
          </div>
        </section>
       <section class="module">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
				<div class="module-subtitle font-serif"><?php echo nl2br($response);?></div>
				<button class="btn btn-sm btn-block btn-round btn-d" type = "button" onclick="window.location.href = 'contact_nonuser.php';">Back
					   </button>
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