# MetaData

MetaData is a collection of utilities for organizing information about objects.

## Installation

Install using [composer](https://getcomposer.org/):

```bash
$ composer require implements7/metadata
```

## Usage

Basic Usage:

```php
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

// Get the data.
$contents = $box->getPackage();

echo $contents;
```



See the examples directory for more use cases.

