<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\Tests\UnitTests\CurrencyExchange\Domain;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use MJankowski\Recruitment\CurrencyExchange\Domain\Model\Money;
use MJankowski\Recruitment\CurrencyExchange\Domain\Model\Currency;

final class MoneyTest extends TestCase
{
    public function testAmountAndCurrencyAreCorrectlySetAndRetrieved(): void
    {
        $currency = new Currency('USD');
        $amount = 123.456;

        $money = new Money($amount, $currency);

        $this->assertSame(123.46, $money->getAmount());
        $this->assertSame($currency, $money->getCurrency());
    }

    public function testAmountIsRoundedCorrectly(): void
    {
        $currency = new Currency('EUR');

        $amount = 123.454;
        $money1 = new Money($amount, $currency);

        $amount = 123.455;
        $money2 = new Money($amount, $currency);

        $this->assertSame(123.45, $money1->getAmount());
        $this->assertSame(123.46, $money2->getAmount());
    }

    public function testNegativeValueThrowsAnException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Money(-100, new Currency('EUR'));
    }
}
