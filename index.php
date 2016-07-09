<?php
require __DIR__ . '/vendor/autoload.php';
// Include the main Propel script
require_once 'vendor/propel/propel1/runtime/lib/Propel.php';

// Initialize Propel with the runtime configuration
Propel::init("build/conf/legacyapp-conf.php");

// Add the generated 'classes' directory to the include path
set_include_path("build/classes" . PATH_SEPARATOR . get_include_path());

?>
<!DOCTYPE html>
<html>
<head>
	<title>PROPEL Master</title>
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
	<h1>Basic C.R.U.D. Operations</h1>
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
	<section class="clearFix">
		<h2>
			Creating Rows
			<p><span>Set</span> and <span>get</span> data to the table</p>
		</h2>
		<div class="result">
			<?php 
				$author = new users();
				$author->setUserName('mike');
				$author->setUserFamily('the cow');
				$author->save();

				echo $author->getUserId();        // 1
				echo $author->getUserName(); // 'Jane'
				echo $author->getUserFamily();  // 'Austen'

				echo $author->toJSON();
			?>
		</div>
		<div class="code">
			<code>
				$author = new users();<br>
				$author->setUserName('mike');<br>
				$author->setUserFamily('the cow');<br>
				$author->save();<br>

				echo $author->getUserId();<br>
				echo $author->getUserName();<br>
				echo $author->getUserFamily();<br>

				echo $author->toJSON();
			</code>
		</div>
	</section>
	<!--
	==============================================================
	-->
	<section class="clearFix">
		<h2>
			Retrieving Rows
			<p>Retrieving objects from the database, also referred to as <span>hydrating objects</span></p>
		</h2>
		<div class="result">
			<pre>
			<?php 
				$q = new usersQuery();
				$firstAuthor = $q->findPK(300);
				echo $firstAuthor;
			?>
			</pre>
		</div>
		<div class="code">
			<code>
	 			$q = new usersQuery();<br>
				$firstAuthor = $q->findPK(300);<br>
				echo $firstAuthor;
			</code>
		</div>
		<p>&nbsp;</p>
		<div class="result">
			<pre>
			<?php 
				$firstAuthor = usersQuery::create()->findPK(150);
				echo $firstAuthor;
			?>
			</pre>
		</div>
		<div class="code">
			<code>
	 			$firstAuthor = usersQuery::create()->findPK(150);<br>
				echo $firstAuthor;<br>
			</code>
		</div>
	</section>

	<section class="clearFix">
		<h2>
			Querying the Database
			<p>To retrieve rows other than by the primary key, use the Query find() method.</p>
		</h2>

		<div class="result">
			<pre>
			<?php 
				$authors = usersQuery::create()
  				->filterByUserName('amin')
  				->find();
  				echo $authors;
			?>
			</pre>
		</div>
		<div class="code">
			<code>
	 			$authors = usersQuery::create()<br>
  				->filterByUserName('amin')<br>
  				->find();<br>
  				echo $authors;<br>
			</code>
		</div>

		<p>&nbsp;</p>
		<div class="result">
			<pre>
			<?php 
				$authors = usersQuery::create()
			    ->orderByUserFamily()
			    ->limit(3)
			    ->find();
			    echo $authors;
			?>
			</pre>	
		</div>
		<div class="code">
			<code>
	 			$authors = usersQuery::create()<br>
			    ->orderByUserFamily()<br>
			    ->limit(3)<br>
			    ->find();<br>
			    echo $authors;<br>
			</code>
		</div>
	</section>

	<!--
	==============================================================
	-->

</body>
</html>