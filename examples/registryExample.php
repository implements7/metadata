<?php declare(strict_types=1);

use MetaData\Items\Hits;
use MetaData\MetaDataBox;
use MetaData\MetaRegistry;
use MetaData\Packers\JsonPacker;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$myVar = 'some string';

$jsonPacker = new JsonPacker();
$box = new MetaDataBox($jsonPacker);

$meta = new MetaRegistry();
$meta->register($myVar, $box);

$hits = new Hits('counters');
$meta->get($myVar)->addItem($hits);
$meta->get($myVar)->getItemByName('counters')->hit('called');
$meta->get($myVar)->getItemByName('counters')->hit('called');

var_dump(['$myVar' => $meta->get($myVar)->getPackage()]);

// Each registration is a copy, so continue to attach original box for new registrations.
$myArray = ['register', 'supports', 'any', 'type'];
$meta->register($myArray, $box);
$meta->get($myArray)->addItem($hits);
$meta->get($myArray)->getItemByName('counters')->hit('called');

var_dump(['$myArray' => $meta->get($myArray)->getPackage()]);

// Call hits on original variable.
$meta->get($myVar)->getItemByName('counters')->hit('called');
$meta->get($myVar)->getItemByName('counters')->hit('called');

// Hits only affect original.
var_dump([
    '$myVar' => $meta->get($myVar)->getPackage(),
    '$myArray' => $meta->get($myArray)->getPackage()
]);
