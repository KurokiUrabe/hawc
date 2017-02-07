<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">

		<title>HAWC</title>
		<meta name="description" content="The HTML5 HAWC">
		<meta name="author" content="Manuel">

		<link rel="stylesheet" href="css/styles.css?v=1.0">

		<!--[if lt IE 9]>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
		<![endif]-->
	</head>

	<body>
	<?php echo utf8_decode (' sne chaîne' ) ?>
			<?php foreach ($colums_name as $key => $colum): ?>
					<div>INSERT INTO `qmdb`.`variables` (`name`, `description`, `type`) VALUES ('<?php echo $colum->name ?>', 'null', 'null'); </div>
			<?php endforeach ?>
		<script src="js/scripts.js"></script>
	</body>
</html>