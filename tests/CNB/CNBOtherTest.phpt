<?php
require_once __DIR__ . '/CNBTestCase.php';
/*
require 'bootstrap.php';
require __DIR__ . '/../../src/Galek/Utils/Exchange/IExchange.php';
require __DIR__ . '/../../src/Galek/Utils/Exchange/CNB/CNB.php';

$basic = new \Galek\Utils\Exchange\CNB\CNB;
*/
use Tester\Assert;
use Galek\Utils\Exchange\CNB\Day;
use Galek\Utils\Exchange\CNB\Other;

class CNBOtherTest extends CNBTestCase
{
	public function testTransferCZFormat()
	{
		Assert::equal(1.42, $this->other->transferToCZK('libra'));
		Assert::equal(1.42, $this->other->transferToCZK(['currency', 'libra']));
		Assert::equal(1.42, $this->other->transferToCZK(['country', 'Egypt']));
		Assert::equal(1.42, $this->other->transferToCZK(['code', 'EGP']));
		/*
		Assert::equal(27.02, $this->other->transferToCZK('euro'));
		Assert::equal(27.02, $this->other->transferToCZK(['currency', 'euro']));
		Assert::equal(27.02, $this->other->transferToCZK(['country', 'EMU']));
		Assert::equal(27.02, $this->other->transferToCZK(['code', 'EUR']));*/
	}

	public function testTransferCZCount()
	{
		Assert::equal(142.4, $this->other->transferToCZK(['code', 'EGP'], 100));
		Assert::equal(14.24, $this->other->transferToCZK(['code', 'EGP'], 10));
		Assert::equal(1.42, $this->other->transferToCZK(['code', 'EGP'], 1));
		Assert::equal(0.0, $this->other->transferToCZK('dong', 1));
		Assert::equal(0.01, $this->other->transferToCZK('dong', 10));
		Assert::equal(0.11, $this->other->transferToCZK('dong', 100));
		//Assert::equal(1.13, $this->other->transferToCZK('dong', 1));
		//Assert::equal(11.26, $this->other->transferToCZK('dong', 10));
		//Assert::equal(112.6, $this->other->transferToCZK('dong', 100));
	}

	public function testTransferOtherCount()
	{
		Assert::equal(100.0, $this->other->transferToOther(['code', 'EGP'], 142.4));
		Assert::equal(10.0, $this->other->transferToOther(['code', 'EGP'], 14.24));
		Assert::equal(1.0, $this->other->transferToOther(['code', 'EGP'], 1.42));

		Assert::equal(1003.55, $this->other->transferToOther('dong', 1.13));
		Assert::equal(10000.0, $this->other->transferToOther('dong', 11.26));
		Assert::equal(100000.0, $this->other->transferToOther('dong', 112.6));
		/*
		Assert::equal(1.0, $this->other->transferToOther('dong', 1.13));
		Assert::equal(10.0, $this->other->transferToOther('dong', 11.26));
		Assert::equal(100.0, $this->other->transferToOther('dong', 112.6));*/
	}

	public function testTransferBetween()
	{
		Assert::equal(0.08, $this->other->transfer('dong', ['code', 'EGP'], 100));
		Assert::equal(126465.36, $this->other->transfer(['code', 'EGP'], 'dong', 100));
	}

	public function testThrows()
	{
		$ex = 'Wrong index ("badvalue") for search, avaible are "country", "currency", "amount", "code" and "rate". For example: findBy("code", "EUR")';
		Assert::throws(function() {
			$other = $this->getNewOther();
			$other->findBy('badvalue');
		}, 'Exception', $ex);
	}
/*
	public function testBasics()
	{
		//Assert::equal([], $this->day->findBy(''));
	}*/
}

$testCase = new CNBOtherTest();
$testCase->run();