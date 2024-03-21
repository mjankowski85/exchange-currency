<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\CurrencyExchange\Domain\Interface;

use MJankowski\Recruitment\CurrencyExchange\Domain\Model\Currency;

interface CurrencyExchangeRateRepositoryInterface
{
    public function getRateFor(Currency $from, Currency $to): float;
}
