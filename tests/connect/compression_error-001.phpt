--TEST--
MongoDB\Driver\Manager: Connecting with unsupported compressor
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php NEEDS('STANDALONE'); ?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";

ini_set('mongodb.debug', 'stdout');
$manager = new MongoDB\Driver\Manager(STANDALONE, [ 'compressors' => 'zli'] );
ini_set('mongodb.debug', null);
?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
%AWARNING > Unsupported compressor: 'zli'%A
===DONE===
