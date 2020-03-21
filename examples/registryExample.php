<?php declare(strict_types=1);

use MetaData\Items\Hits;
use MetaData\MetaDataBox;
use MetaData\MetaRegistry;
use MetaData\Packers\JsonPacker;

require_once 'vendor/autoload.php';

class MyClass implements \MetaData\MetaTrackableInterface {
    public string $value = '';
}

$myVar = new MyClass();
$myVar->value = 'test';

$meta = new MetaRegistry();

$box = new MetaDataBox(new JsonPacker());
$hits = new Hits('counters');
$box->addItem($hits);

$meta->register($myVar, $box);
$meta->get($myVar)->getItemByName('counters')->hit('called');

// Modifying original object does not affect meta association.
$myVar->value = 'testModified';
var_dump(['$myVar' => $meta->get($myVar)->getPackage()]);

// Objects can be registered and accessed by name.
$name = 'TrackMe';
$meta->register($myVar, $box, $name);
$meta->getByName($name)->getItemByName('counters')->hit('called');
var_dump(['named registration' => $meta->getByName($name)->getPackage()]);

// For convenience, objects registered by name can use ArrayAccess via registry.
$meta[$name]->getItemByName('counters')->hit('called');
var_dump(['named registration (ArrayAccess)' => $meta[$name]->getPackage()]);
