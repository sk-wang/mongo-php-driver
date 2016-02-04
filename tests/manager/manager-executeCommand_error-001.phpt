--TEST--
MongoDB\Driver\Manager::executeCommand() should not issue warning before exception
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";

$command = new MongoDB\Driver\Command(['ping' => 1]);

// Invalid host cannot be resolved
$manager = new MongoDB\Driver\Manager('mongodb://invalid.host:27017', ['serverSelectionTimeoutMS' => 1]);

echo throws(function() use ($manager, $command) {
    $manager->executeCommand(DATABASE_NAME, $command);
}, 'MongoDB\Driver\Exception\RuntimeException'), "\n";

// Valid host refuses connection
$manager = new MongoDB\Driver\Manager('mongodb://localhost:54321', ['serverSelectionTimeoutMS' => 1]);

echo throws(function() use ($manager, $command) {
    $manager->executeCommand(DATABASE_NAME, $command);
}, 'MongoDB\Driver\Exception\RuntimeException'), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
OK: Got MongoDB\Driver\Exception\RuntimeException
No suitable servers found (`serverselectiontryonce` set): [Failed connecting to 'invalid.host:27017': php_network_getaddresses: getaddrinfo failed: Name or service not known]
OK: Got MongoDB\Driver\Exception\RuntimeException
No suitable servers found (`serverselectiontryonce` set): [Failed connecting to 'localhost:54321': Connection refused]
===DONE===
