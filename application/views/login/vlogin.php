<html>
	<head>
		<title><?= $page_title; ?></title>
		<!-- Stylesheets -->
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
		<link rel="stylesheet" href="assets/css/style.css">

		<!-- Scripts -->
		<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	</head>
	<body>
		<div class="login_wrapper pure-g">
			<?= $this->load->view($page_path); ?>
		</div>
	</body>
</html>