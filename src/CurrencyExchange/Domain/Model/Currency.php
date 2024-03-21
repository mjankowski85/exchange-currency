<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\CurrencyExchange\Domain\Model;

readonly class Currency
{
    public function __construct(
        private string $code
    ) {
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
