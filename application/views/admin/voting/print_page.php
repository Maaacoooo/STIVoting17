<!DOCTYPE html>
<html>
<head>
	<title><?=$title?> &middot; <?=$site_title?></title>
</head>
<style>
	html {
		display: block;
	}
	div.container {
		border-collapse: collapse;

	}
	div.passes {
		border: 1px solid black;
		width: 1.65in;
		text-align: center;		
		border-collapse: collapse;
		display: inline-block;
		margin: 0;
		padding: 0;
		float: left;
	}
	div.passes h1 {
		margin: 0;
		padding: 0;
		font-family: "Arial";
	}

	div.passes small {
		display: block;
		margin: 0;
		padding: 0;
		font-family: "Calibri";
	}
</style>
<body onload="#javascript:print()">
	<div class="container">
	<?php foreach($passes as $pass): ?>
		<div class="passes">
			<h1><?=$pass['key']?></h1>
			<small><?=$site_title?></small>
			<small><?=nice_date($pass['updated_at'], 'm-d-y')?></small>

		</div><!-- /.passes -->
	<?php endforeach; ?>
	</div><!-- /.container -->
</body>
</html>