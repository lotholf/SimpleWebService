<?php
$autoload = require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

require __DIR__.'/../src/Controllers.php';

$app->run();
