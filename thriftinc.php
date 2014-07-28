<?php
require_once __DIR__ . '/lib/thrift/Thrift/ClassLoader/ThriftClassLoader.php';
use Thrift\ClassLoader\ThriftClassLoader;

$GEN_DIR = realpath(dirname(__FILE__)) . '/gen/gen-php';
$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift', __DIR__ . '/lib/thrift');
$loader->registerDefinition('thrift', $GEN_DIR);
$loader->register();

?>