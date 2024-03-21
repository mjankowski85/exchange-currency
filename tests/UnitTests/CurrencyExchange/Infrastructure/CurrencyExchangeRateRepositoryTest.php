<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\Tests\UnitTests\CurrencyExchange\Infrastructure;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use MJankowski\Recruitment\CurrencyExchange\Domain\Model\Currency;
use MJankowski\Recruitment\CurrencyExchange\Domain\Exception\UnsupportedCurrencyException;
use MJankowski\Recruitment\CurrencyExchange\Infrastructure\Repository\CurrencyExchangeRateRepository;

final class CurrencyExchangeRateRepositoryTest extends TestCase
{
    private CurrencyExchangeRateRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new CurrencyExchangeRateRepository();
    }

    public function testGetRateForExistingPair(): void
    {
        $from = new Currency('EUR');
        $to = new Currency('GBP');

        $rate = $this->repository->getRateFor($from, $to);

        $this->assertSame(0.85, $rate);
    }

    #[DataProvider('currencyPairProvider')]
    public function testGetRateForUnsupportedCurrencyPairThrowsException(Currency $currency1, Currency $currency2): void
    {
        $this->expectException(UnsupportedCurrencyException::class);

        $this->repository->getRateFor($currency1, $currency2);
    }

    public static function currencyPairProvider(): array
    {
        return [
            'Both currencies are invalid' => [new Currency('USD'), new Currency('PLN')],
            'First currency is invalid' => [new Currency('PLN'), new Currency('EUR')],
            'Second currency is invalid' => [new Currency('EUR'), new Currency('PLN')],
        ];
    }
}
