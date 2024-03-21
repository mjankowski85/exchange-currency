<?php

namespace MJankowski\Recruitment\CurrencyExchange\Domain\Service;

readonly class Fee
{
    private const FEE_PERCENTAGE = 0.01; // 1%

    public static function calculateForAmount(float $amount): float
    {
        return $amount * self::FEE_PERCENTAGE;
    }
}