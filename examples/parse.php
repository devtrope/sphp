<?php

require __DIR__ . '/../vendor/autoload.php';

$parser = new Sphp\Parser();
$configuration = $parser->parseFile(__DIR__ . '/services.sphp');
var_dump($configuration);