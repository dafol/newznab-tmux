<?php
//This script will update all records in the xxxinfo table where there is no cover
require_once(dirname(__FILE__) . "/../../../bin/config.php");

use newznab\db\Settings;


$pdo = new Settings();
$movie = new XXX();
$c = new ColorCLI();

$movies = $pdo->queryDirect("SELECT title FROM xxxinfo WHERE cover = 0");
if ($movies instanceof Traversable) {
	echo $c->primary("Updating " . number_format($movies->rowCount()) . " XXX movie covers.");
	foreach ($movies as $mov) {
		$starttime = microtime(true);
		$mov = $movie->updateXXXInfo($mov['title']);

		// sleep so that it's not ddos' the site
		$diff = floor((microtime(true) - $starttime) * 1000000);
		if (333333 - $diff > 0) {
			echo "\nsleeping\n";
			usleep(333333 - $diff);
		}
	}
	echo "\n";
}