<?php
require_once __DIR__ . '/CNBTestCase.php';

use Tester\Assert;

class CNBDayAllTest extends CNBTestCase
{
	public function testGetAll()
	{
		$s = [
			"usa" => [
				"country" => "USA",
				"currency" => "dolar",
				"amount" => "1",
				"code" => "USD",
				"rate" => "25.335"
			]
		];
		$all = $this->day->getAll();

		Assert::same($s['usa'], $all['usa']);
	}
}

$testCase = new CNBDayAllTest();
$testCase->run();
