# Workdays

[![Downloads this Month](https://img.shields.io/packagist/dm/h4kuna/workdays.svg)](https://packagist.org/packages/h4kuna/workdays)
[![Latest Stable Version](https://poser.pugx.org/h4kuna/workdays/v/stable?format=flat)](https://packagist.org/packages/h4kuna/workdays)
[![Coverage Status](https://coveralls.io/repos/github/h4kuna/workdays/badge.svg?branch=main)](https://coveralls.io/github/h4kuna/workdays?branch=main)
[![Total Downloads](https://poser.pugx.org/h4kuna/workdays/downloads?format=flat)](https://packagist.org/packages/h4kuna/workdays)
[![License](https://poser.pugx.org/h4kuna/workdays/license?format=flat)](https://packagist.org/packages/h4kuna/workdays)

Part of the [h4kuna PHP libraries](https://github.com/h4kuna/library), see the overview of all packages.

Public holidays and workdays for the Czech Republic and Slovakia.

## Installation

Requires PHP 8.4 or newer.

```sh
composer require h4kuna/workdays
```

## Usage

```php
use h4kuna\Workdays;
$builder = Workdays\Factory::create();

$workdays = $builder->get('cs_CZ');

$datetime = new DateTime('2016-01-04 12:46:28');

echo ($workdays->isHoliday($datetime) ? 'true' : 'false') . PHP_EOL;
// false

echo ($workdays->isWorkday($datetime) ? 'true' : 'false') . PHP_EOL;
// true

$nextHoliday = $workdays->nextHoliday($datetime);
echo $nextHoliday->name . PHP_EOL;
// Velký pátek
echo $nextHoliday->date->format('Y-m-d H:i:s') . PHP_EOL;
// 2016-03-25 00:00:00

echo $workdays->nextWorkday($datetime)->format('Y-m-d H:i:s') . PHP_EOL;
// 2016-01-05 12:46:28

// returns a new object, $datetime is not modified
$moved = $workdays->moveWorkdays($datetime, 7);
echo $moved->format('Y-m-d H:i:s') . PHP_EOL;
// 2016-01-13 12:46:28


$workdays = $builder->get('sk_SK');
$datetime = new DateTime('2016-01-04 12:43:28');

echo ($workdays->isHoliday($datetime) ? 'true' : 'false') . PHP_EOL;
// false

echo ($workdays->isWorkday($datetime) ? 'true' : 'false') . PHP_EOL;
// true

$nextHoliday = $workdays->nextHoliday($datetime);
echo $nextHoliday->name . PHP_EOL;
// Zjavenie Pána
echo $nextHoliday->date->format('Y-m-d H:i:s') . PHP_EOL;
// 2016-01-06 00:00:00

echo $workdays->nextWorkday($datetime)->format('Y-m-d H:i:s') . PHP_EOL;
// 2016-01-05 12:43:28

$moved = $workdays->moveWorkdays($datetime, 7);
echo $moved->format('Y-m-d H:i:s') . PHP_EOL;
// 2016-01-14 12:43:28
```

### Custom holiday providers

Extend `BaseProvider` and return the holidays of the given year. The list must not be empty and all dates must be in the requested year.

```php
use h4kuna\Workdays;
use h4kuna\Workdays\HolidaysProvider\BaseProvider;
use h4kuna\Workdays\HolidaysProvider\Holiday;

class CustomHolidaysProvider extends BaseProvider
{
    protected function holidaysInYear(int $year): array
    {
        return [
            new Holiday(new DateTimeImmutable($year . '-01-01'), 'New Year\'s Day'),
            // ...
        ];
    }
}

$builder = Workdays\Factory::create();
$builder->addProvider('myProvider', new CustomHolidaysProvider());

// get Workdays with your provider by the name used in addProvider()
$workdays = $builder->get('myProvider');
```
