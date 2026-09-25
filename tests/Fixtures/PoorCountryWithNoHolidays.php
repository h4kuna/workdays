<?php declare(strict_types = 1);

namespace h4kuna\Workdays\Tests\Fixtures;

use h4kuna\Workdays\HolidaysProvider\BaseProvider;

class PoorCountryWithNoHolidays extends BaseProvider
{

	public function holidaysInYear(int $year): array
	{
		return [];
	}

}
