<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
	
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<!--<link rel="stylesheet" href="{{ asset('css/style.css') }}" />-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
	<style>
	
		/*
		---------------------------
		general styles
		--------------------------- */

		/*body {
			background: #e9edf0;
		}*/
		div#container {
			width: 55%;
			margin: 20px 40px;
			padding: 20px;
			background: #fff;
		}


		/*
		-----------------------------------------------------------------
		form
		----------------------------------------------------------------- */

		form.dm_form {
			width: 100%;
			font-family: sans-serif; font-size: 0.8em;
			margin: 0;
			padding: 0;
			border: 0;
		}
		form.dm_form div.form_wrapper {
			margin: 0 -1%;
			padding: 0;
		}
		form.dm_form fieldset {
			/*clear: both;*/
			margin: 0 10px 20px 10px;
			padding: 0;
			border: 0;
			float: left;
			width: 48%;
		}
		.singleRow {
			float: left;
			width: 48%;
		}


		/*
		---------------------------
		labels and wrappers
		--------------------------- */

		form.dm_form label {
			margin: 0 1%;
			padding: 0;
			border: 0;
			float: left;
			display: table;
			width: 1%;
		}
		form.dm_form span.wrapper {
			margin: 0;
			padding: 0;
			display: table-cell;
			width: 1%; /* firefox */
		}


		/*
		---------------------------
		width
		--------------------------- */

		form.dm_form label.w100 {
			width: 98%;
			display: block;
		}
		form.dm_form label.w75 {
			width: 73%;
			display: block;
		}
		form.dm_form label.w50 {
			width: 48%;
			display: block;
		}
		form.dm_form label.w25 {
			width: 23%;
			display: block;
		}


		/*
		---------------------------
		position
		--------------------------- */

		form.dm_form label.p25 {
			margin-left: 26%;
		}
		form.dm_form label.p50 {
			margin-left: 51%;
		}
		form.dm_form label.p75 {
			margin-left: 76%;
		}


		/*
		---------------------------
		errors
		--------------------------- */

		form.dm_form label.error input.field,
		form.dm_form label.error select.field,
		form.dm_form label.error textarea.field {
			border-color: #dd1100;
		}
		form.dm_form label.error span.title {
			color: #dd1100;
		}


		/*
		---------------------------
		title and examples 
		--------------------------- */

		form.dm_form label span.title {
		}
		form.dm_form label span.example {
			color: #999;
			font-style: italic;	
		}


		/*
		---------------------------
		input/select fields 
		--------------------------- */

		form.dm_form label input.field,
		form.dm_form label select.field,
		form.dm_form label textarea.field {
			width: 100%;
			display: block;
			border: 1px solid #d0d6da;
			border-left: 3px solid #809db5;
			background: #e9edf0;
			padding: 4px;
			font-family: sans-serif; font-size: 1em;
			box-sizing: border-box;
			-moz-box-sizing: border-box; /* gecko */
			-webkit-box-sizing: border-box; /* khtml/webkit */
			-ms-box-sizing: border-box; /* IE */
		}
		form.dm_form label select.field {
			padding: 4px 1px 1px 1px; /* have to try out */
		}
		form.dm_form label input.field:focus,
		form.dm_form label select.field:focus,
		form.dm_form label textarea.field:focus {
			border: 1px solid #d0d6da;
			border-left: 3px solid #57ab44;
			background: #e0eadd;
		}

		/* Pflichtfelder
			mandatory fields */
		form.dm_form label.mandatory input.field,
		form.dm_form label.mandatory select.field,
		form.dm_form label.mandatory textarea.field {
			border: 1px solid #809db5;
			border-left: 8px solid #809db5;
		}


		/*
		---------------------------
		submit button
		--------------------------- */

		form.dm_form input.submit {
			width: 100%;
			background: #809db5;
			color: #fff;
			padding: 2px 0;
			font-size: 1em;
		}
		form.dm_form input.submit:hover,
		form.dm_form input.submit:focus {
			background: #57ab44;
			/* cursor: pointer;  sorry, can't use that one in front of Opera */
		}


		/*
		---------------------------
		additional styles for
		input/select fields
		--------------------------- */

		form.dm_form label.inputselect span.title {
			margin: 0 0 2px 0;
			display: table; /* act as inline-block */
		}
		form.dm_form label span.title:hover,
		form.dm_form label span.title:focus {
			color: #57ab44;
			cursor: pointer;
		}
		form.dm_form label br {
			margin: 0 0 2px 0;
		}


		/*
		---------------------------
		clearing elements
		--------------------------- */

		.clear {
			clear: both;
			display: block;
			padding: 0 0 10px 0;
		}
		.mb0 {
			margin-bottom: 0 !important;
		}
		.pb20 {
			padding-bottom: 20px !important;
		}


		/*
		---------------------------
		form content
		--------------------------- */

		form.dm_form p,
		form.dm_form h3 {
			margin: 0 1% 10px 1%;
		}
		div.errors {
			display: none; /* JS toggle */
			margin: 0 1% 30px 1%;
			padding: 5px 10px;
			background: #dd1100;
		}
		div.errors p {
			color: #fff;
			margin: 0 0 0.5em 0;
		}
		div.errors ul {
			margin: 0 0 0 1.6em;
			padding: 0;
		}
		div.errors ul li {
			margin: 0;
			padding: 0;
			color: #fff;
			list-style-type: square;
		}

	</style>
	
	<script type="text/javascript" >
		$(document).ready(function(){
			$('tr.header').nextUntil('tr.header').slideToggle(100);
			$('tr.header').click(function(){
				$(this).find('span').text(function(_, value){return value=='-'?'+':'-'});
				$(this).nextUntil('tr.header').slideToggle(100, function(){
				});
			});
		});
	</script>
	
</head>
<body>
	<!-- navigation bar -->
	<div class="container">
		<div class="row">
			<div class="col">
				<ul class="nav justify-content-left">
					<li class="nav-item">
						<a class="nav-link" href="/home">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/esrpaymentslips">ESR Payment Slips</a>
					</li>
					<!--<li class="nav-item">
						<a class="nav-link" href="/customers/list">Customers</a>
					</li>-->
					<!--<li class="nav-item">
						<a class="nav-link" href="/invoices/list">Invoices</a>
					</li>-->
				</ul>
			</div>
		</div>
	</div>
	<!-- navigation bar ends here -->
	
	<!-- content section -->
	<div class="container">
		@yield('content')
	</div>
	<!-- content section ends here -->
	
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<!--<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>-->
   
</body>
</html>