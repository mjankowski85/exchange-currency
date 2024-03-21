<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\Tests\UnitTest\CurrencyExchange\Domain;

use PHPUnit\Framework\TestCase;
use MJankowski\Recruitment\CurrencyExchange\Domain\Model\Money;
use MJankowski\Recruitment\CurrencyExchange\Domain\Model\Currency;
use MJankowski\Recruitment\CurrencyExchange\Domain\Service\CurrencyExchangeService;
use MJankowski\Recruitment\CurrencyExchange\Domain\Interface\CurrencyExchangeRateRepositoryInterface;
use MJankowski\Recruitment\CurrencyExchange\Infrastructure\Repository\CurrencyExchangeRateRepository;

class CurrencyExchangeServiceTest extends TestCase
{
    private CurrencyExchangeService $service;

    private Currency $eur;

    private Currency $gbp;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CurrencyExchangeService(new CurrencyExchangeRateRepository());
        $this->eur = new Currency('EUR');
        $this->gbp = new Currency('GBP');
    }

    public function testSell100EurForGbp(): void
    {
        $moneyToSell = new Money(100, $this->eur);

        $moneyReceived = $this->service->sellMoney($moneyToSell, $this->gbp);

        $this->assertInstanceOf(Money::class, $moneyReceived);
        $this->assertEquals($this->gbp, $moneyReceived->getCurrency());
        $this->assertEquals(83.75, $moneyReceived->getAmount());
    }

    public function testBuy100GbpForEur(): void
    {
        $moneyToBuy = new Money(100, $this->gbp);

        $moneyToPay = $this->service->buyMoney($moneyToBuy, $this->eur);

        $this->assertInstanceOf(Money::class, $moneyToPay);
        $this->assertEquals($this->eur, $moneyToPay->getCurrency());
        $this->assertEquals(118.82, $moneyToPay->getAmount());
    }

    public function testSell100GbpForEur(): void
    {
        $moneyToSell = new Money(100, $this->gbp);

        $moneyReceived = $this->service->sellMoney($moneyToSell, $this->eur);

        $this->assertInstanceOf(Money::class, $moneyReceived);
        $this->assertEquals($this->eur, $moneyReceived->getCurrency());
        $this->assertEquals(115.83, $moneyReceived->getAmount());
    }

    public function testBuy100EurForGbp(): void
    {
        $moneyToBuy = new Money(100, $this->eur);

        $moneyToPay = $this->service->buyMoney($moneyToBuy, $this->gbp);

        $this->assertInstanceOf(Money::class, $moneyToPay);
        $this->assertEquals($this->gbp, $moneyToPay->getCurrency());
        $this->assertEquals(86.72, $moneyToPay->getAmount());
    }

    public function testBuyMoneyCalculatesAmountCorrectly(): void
    {
        $exchangeRateRepositoryMock = $this->createMock(CurrencyExchangeRateRepositoryInterface::class);
        $exchangeRateRepositoryMock->method('getRateFor')->willReturn(1.2);
        $service = new CurrencyExchangeService($exchangeRateRepositoryMock);
        $moneyToBuy = new Money(120, new Currency('EUR'));
        $currencyToPay = new Currency('GBP');

        $result = $service->buyMoney($moneyToBuy, $currencyToPay);

        $this->assertEquals(101, $result->getAmount());
        $this->assertEquals('GBP', $result->getCurrency()->getCode());
    }

    public function testSellMoneyCalculatesAmountCorrectly(): void
    {
        $exchangeRateRepositoryMock = $this->createMock(CurrencyExchangeRateRepositoryInterface::class);
        $exchangeRateRepositoryMock->method('getRateFor')->willReturn(0.8);
        $service = new CurrencyExchangeService($exchangeRateRepositoryMock);
        $moneyToSell = new Money(100, new Currency('GBP'));
        $currencyToGet = new Currency('EUR');

        $result = $service->sellMoney($moneyToSell, $currencyToGet);

        $this->assertEquals(78.75, $result->getAmount());
        $this->assertEquals('EUR', $result->getCurrency()->getCode());
    }
}
