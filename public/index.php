<?php

require_once "../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = __DIR__ . '/../views';
$cache = __DIR__ . '/../cache';
define("BLADEONE_MODE", 1); // (optional) 1=forced (test),2=run fast (production), 0=automatic, default value.
$blade = new BladeOne($views, $cache);

echo $blade->run("portada");