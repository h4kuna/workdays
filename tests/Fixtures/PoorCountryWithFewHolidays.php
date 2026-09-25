<?php declare(strict_types = 1);

namespace h4kuna\Workdays\Tests\Fixtures;

use DateTimeImmutable;
use h4kuna\Workdays\HolidaysProvider\BaseProvider;
use h4kuna\Workdays\HolidaysProvider\Holiday;

class PoorCountryWithFewHolidays extends BaseProvider
{

	protected function holidaysInYear(int $year): array
	{
		return [
			new Holiday(new DateTimeImmutable($year . '-12-24'), 'Christmas'),
			new Holiday(new DateTimeImmutable($year . '-12-23'), 'pre Christmas', true),
			new Holiday(new DateTimeImmutable($year . '-12-24'), 'Not save, because is vacation', true),
		];
	}

}
