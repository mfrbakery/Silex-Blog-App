<?php
$app = require_once dirname(__DIR__)."/MyApp/config.php";
$app['http_cache']->run();
