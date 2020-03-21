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

$jsonPacker = new JsonPacker();
$box = new MetaDataBox($jsonPacker);

$box->addItem($hits);
echo $box->getPackage();
