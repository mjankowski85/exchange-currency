<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\CurrencyExchange\Infrastructure\Repository;

use MJankowski\Recruitment\CurrencyExchange\Domain\Model\Currency;
use MJankowski\Recruitment\CurrencyExchange\Domain\Exception\UnsupportedCurrencyException;
use MJankowski\Recruitment\CurrencyExchange\Domain\Interface\CurrencyExchangeRateRepositoryInterface;

class CurrencyExchangeRateRepository implements CurrencyExchangeRateRepositoryInterface
{
    /**
     * @var array<string, float> Exchange rates between currencies.
     */
    private array $exchangeRates = [
        'EURtoGBP' => 0.85,
        'GBPtoEUR' => 1.17,
    ];

    public function getRateFor(Currency $from, Currency $to): float
    {
        $exchangeKey = $from->getCode() . 'to' . $to->getCode();
        if (! isset($this->exchangeRates[$exchangeKey])) {
            throw new UnsupportedCurrencyException("Unsupported currency pair: {$from->getCode()} to {$to->getCode()}");
        }

        return $this->exchangeRates[$exchangeKey];
    }
}
