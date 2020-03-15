<?php declare(strict_types=1);

use MetaData\MetaDataBox;
use MetaData\MetaItemInterface;
use MetaData\MetaValueInterface;
use MetaData\Packers\JsonPacker;
use MetaData\Values\StringArrayMetaValue;
use MetaData\Values\StringMetaValue;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$userBio = new class implements MetaItemInterface {
    public function getName(): string
    {
        return 'User Bio';
    }

    public function getValue(): MetaValueInterface
    {
        return new StringArrayMetaValue([
            'Name' => 'John',
            'Age' => '37',
            'Job' => 'Programmer'
        ]);
    }
};

$jsonPacker = new JsonPacker();
$box = new MetaDataBox($jsonPacker);
$box->addItem($userBio);

$location = new class implements MetaItemInterface {
    public function getName(): string
    {
        return 'Location';
    }

    public function getValue(): MetaValueInterface
    {
        return new StringMetaValue('Las Vegas');
    }
};

$box->addItem($location);

$contents = $box->getPackage();

echo $contents;

