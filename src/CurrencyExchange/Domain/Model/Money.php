<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\CurrencyExchange\Domain\Model;

use InvalidArgumentException;

readonly class Money
{
    public function __construct(
        private float $amount,
        private Currency $currency
    ) {
        if ($this->amount <= 0) {
            throw new InvalidArgumentException('Amount must be greater than 0.');
        }
    }

    public function getAmount(): float
    {
        return round($this->amount, 2);
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }
}
