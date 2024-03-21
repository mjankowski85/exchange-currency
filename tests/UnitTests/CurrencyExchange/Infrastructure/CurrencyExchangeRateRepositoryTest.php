<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\Tests\UnitTests\CurrencyExchange\Infrastructure;

use PHPUnit\Framework\TestCase;
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

    public function testGetRateForNonExistingPairReturnsZero(): void
    {
        $this->expectException(UnsupportedCurrencyException::class);

        $from = new Currency('USD');
        $to = new Currency('CAD');

        $this->repository->getRateFor($from, $to);
    }
}
