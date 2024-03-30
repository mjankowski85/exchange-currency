<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\CurrencyExchange\Domain\Utility;

readonly class Fee
{
    private const float FEE_PERCENTAGE = 0.01;

    public static function calculateForAmount(float $amount): float
    {
        $fee = $amount * self::FEE_PERCENTAGE;
        return ($fee < 1) ? 1.25 : $fee;
    }
}
