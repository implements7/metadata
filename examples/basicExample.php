<?php declare(strict_types=1);

use MetaData\MetaDataBox;
use MetaData\MetaItemInterface;
use MetaData\MetaValueInterface;
use MetaData\Packers\JsonPacker;
use MetaData\Values\ArrayMetaValue;
use MetaData\Values\StringMetaValue;

require_once 'vendor/autoload.php';

// A class that defines the data to be stored.
$userBio = new class implements MetaItemInterface {
    public function getName(): string
    {
        return 'User Bio';
    }

    public function getValue(): MetaValueInterface
    {
        return new ArrayMetaValue([
            'Name' => 'John',
            'Age' => 37,
            'Job' => 'Programmer',
            'Tags' => ['PHP', 'Go']
        ]);
    }
};

// The format of the "packed" data.
$jsonPacker = new JsonPacker();

// Adding data.
$box = new MetaDataBox($jsonPacker);
$box->addItem($userBio);

// Another class to track additional data.
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

// Get the data.
$contents = $box->getPackage();

echo $contents;

