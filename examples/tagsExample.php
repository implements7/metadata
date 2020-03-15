<?php declare(strict_types=1);

use MetaData\Items\Tags;
use MetaData\MetaDataBox;
use MetaData\Packers\JsonPacker;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$tags = new Tags('Planets');
$tags->add('Mercury');
$tags->add('Venus');
$tags->add('Earth');
$tags->add('Mars');
$tags->add('Jupiter');
$tags->add('Saturn');
$tags->add('Uranus');
$tags->add('Neptune');

// Duplicate values are possible.
$tags->add('Earth');
$tags->add('Mars');

$jsonPacker = new JsonPacker();
$box = new MetaDataBox($jsonPacker);
$box->addItem($tags);

echo $box->getPackage();