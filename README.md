# MetaData

MetaData is a collection of utilities for organizing information about objects.

## Installation

Install using [composer](https://getcomposer.org/):

```bash
$ composer require implements7/metadata
```

## Usage

The following example demonstrates creating meta items, adding them to a box, and getting the contents as JSON output. 

```php
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

// Adding data.
$box = new MetaDataBox();
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

// The format of the "packed" data.
$packer = new JsonPacker();

// Get the data.
$contents = $box->getPackage($packer);

echo $contents;
```

See the [examples](examples/) directory for more use cases.

