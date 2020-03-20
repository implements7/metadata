<?php declare(strict_types=1);

use MetaData\Items\Hits;
use MetaData\MetaDataBox;
use MetaData\MetaRegistry;
use MetaData\Packers\JsonPacker;

require_once dirname(__DIR__) . '/vendor/autoload.php';

class MyClass implements \MetaData\MetaTrackableInterface {
    public string $value = '';
}

$myVar = new MyClass();
$myVar->value = 'test';

$jsonPacker = new JsonPacker();
$box = new MetaDataBox($jsonPacker);

$meta = new MetaRegistry();
$meta->register($myVar, $box);

$hits = new Hits('counters');
$meta->get($myVar)->addItem($hits);
$meta->get($myVar)->getItemByName('counters')->hit('called');
$meta->get($myVar)->getItemByName('counters')->hit('called');

// Modifying original object does not affect meta association.
$myVar->value = 'testModified';
var_dump(['$myVar' => $meta->get($myVar)->getPackage()]);

// Re-registering an object will overwrite meta association.
$meta->register($myVar, $box);
var_dump(['$myVar' => $meta->get($myVar)->getPackage()]);

// Since boxes are cloned on registration, direct box access will not yield registry values:
try {
    $box->getItemByName('counters')->hit('called');
} catch (RuntimeException $e) {
    var_dump($e->getMessage());
}