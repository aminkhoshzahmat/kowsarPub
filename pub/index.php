<?php
	require __DIR__ . '/vendor/autoload.php';

	use Monolog\Logger;
	use Monolog\Handler\StreamHandler;


	$log = new Logger('name');
	$log->pushHandler(new StreamHandler('app.txt', Logger::WARNING));
	$log->addWarning('Request');


?>