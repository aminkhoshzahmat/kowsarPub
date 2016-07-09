<?php
require __DIR__ . '/vendor/autoload.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>TWIG</title>
	<link rel="stylesheet" href="css/composerTwig.css">
</head>
<body>
	<nav class="clearFix">
		<ul>
			<li><a href="index.php">C.R.U.D</a></li>
			<li><a href="twig.php">Twig</a></li>
			<li><a href="index.php">Validators</a></li>
		</ul>
	</nav>
	<h1>TWIG</h1>
	<!--
	==============================================================
	-->
	<section>
		<?php
		$loader = new Twig_Loader_Array(array(
		    'index' => 'Hello {{ name }}!',
		));
		$twig = new Twig_Environment($loader);

		echo $twig->render('index', array('name' => 'Fabien'));
		?>
	</section>	
	<!--
	==============================================================
	-->

</body>
</html>