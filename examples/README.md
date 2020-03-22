# MetaData Examples

The examples in this directory demonstrate potential use cases for utilities in the MetaData package.

## Usage

Ensure the package has been fully installed using composer (see README in root).

Run the examples in this directory from the project root to ensure access to the autoloader.

e.g.

`$ php vendor/implements7/metadata/examples/basicExample.php`

## Tags Example

A collection of tags can be built using the provided Tags item class. 

```php
<?php declare(strict_types=1);

use MetaData\Filters\UniqueArray;
use MetaData\Items\Tags;
use MetaData\MetaDataBox;
use MetaData\Packers\ArrayPacker;
use MetaData\Packers\JsonPacker;

require_once 'vendor/autoload.php';

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

// Use a filter to remove duplicates.
$filter = new UniqueArray();
$tags->addFilter($filter);
$tags->filterValues();

$jsonPacker = new JsonPacker();
$box = new MetaDataBox();
$box->addItem($tags);

var_dump(
    $box->getPackage(new ArrayPacker())
);
```

## Hits Example

Hits can be used for counters and other countable things.

```php
<?php declare(strict_types=1);

use MetaData\Items\Hits;
use MetaData\MetaDataBox;
use MetaData\Packers\JsonPacker;

require_once 'vendor/autoload.php';

echo 'Running example...', "\n";

$hits = new Hits('counters');

$years = 3;
$daysPerYear = 365;
$hoursPerDay = 24;
$minutesPerHour = 60;
$secondsPerMinute = 60;

for ($y = 0; $y < $years; $y++) {
    $hits->hit('years');
    for ($d = 0; $d < $daysPerYear; $d++) {
        $hits->hit('days');
        for ($h = 0; $h < $hoursPerDay; $h++) {
            $hits->hit('hours');
            for ($m = 0; $m < $minutesPerHour; $m++) {
                $hits->hit('minutes');
                for ($s = 0; $s < $secondsPerMinute; $s++) {
                    $hits->hit('seconds');
                }
            }
        }
    }
}

$box = new MetaDataBox();
$box->addItem($hits);

echo $box->getPackage(new JsonPacker());
```

## Registry Examples

The MetaRegistry class provides methods for tracking objects, invoking their items' functions, and for getting meta data payloads for tracked objects.

### Using the Registry Methods

```php
<?php declare(strict_types=1);

use MetaData\Items\Hits;
use MetaData\MetaDataBox;
use MetaData\MetaRegistry;
use MetaData\MetaTrackableInterface;
use MetaData\Packers\JsonPacker;

require_once 'vendor/autoload.php';

$myVar = new class implements MetaTrackableInterface {
    public string $value = 'test';
};

$meta = new MetaRegistry();

$box = new MetaDataBox();
$hits = new Hits('counters');
$box->addItem($hits);

$packer = new JsonPacker();

$meta->register($myVar, $box);
$meta->get($myVar)->getItemByName('counters')->hit('called');

// Modifying original object does not affect meta association.
$myVar->value = 'testModified';

var_dump(['$myVar' => $meta->get($myVar)->getPackage($packer)]);

// Objects can be registered and accessed by name.
$name = 'TrackMe';
$meta->register($myVar, $box, $name);
$meta->getByName($name)->getItemByName('counters')->hit('called');

var_dump(['named registration' => $meta->getByName($name)->getPackage($packer)]);
```

### Using the Magical Features of the Registry

Since working with the registry can result in a lot of typing, several magical features have been built in to it, as well as the related Meta components that it utilizes.

The following example demonstrated the magical properties of the Registry.

```php
<?php declare(strict_types=1);

use MetaData\Items\Hits;
use MetaData\MetaDataBox;
use MetaData\MetaRegistry;
use MetaData\MetaTrackableInterface;
use MetaData\Packers\JsonPacker;

require_once 'vendor/autoload.php';

$myVar = new class implements MetaTrackableInterface {
    public string $value = 'test';
};

$meta = new MetaRegistry();

$box = new MetaDataBox();
$hits = new Hits('counters');
$box->addItem($hits);

$packer = new JsonPacker();

$name = 'TrackMe';
$meta->register($myVar, $box, $name);

// For convenience, objects registered by name can use ArrayAccess via registry.
$meta[$name]->getItemByName('counters')->hit('called');

var_dump(['named registration (ArrayAccess)' => $meta[$name]->getPackage($packer)]);

// The box also supports array access, so we can do this.
$meta[$name]['counters']->hit('called');
$meta[$name]['counters']->hit('called');

var_dump(['counters (ArrayAccess)' => $meta[$name]->getPackage($packer)]);

// We can also call them as functions.
$meta[$name]['counters']('called');
$meta[$name]['counters']('called');
$meta[$name]['counters']('called');

var_dump(['counters as ActionItemInterface (ArrayAccess)' => $meta[$name]->getPackage($packer)]);

// Like array access, object access is also available by calling the function on a member.
($meta->TrackMe->counters)('ObjectAccessInvoked');

// The above example is awkward, so method call is also supported.
$meta->TrackMe->counters('ObjectAccessInvoked');

var_dump(['counters as ObjectAccess' => $meta[$name]->getPackage($packer)]);
```

