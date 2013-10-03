<?php

$loader = require_once __DIR__.'/../vendor/autoload.php';
$loader->add('Hateoas\\Tests', __DIR__);

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
