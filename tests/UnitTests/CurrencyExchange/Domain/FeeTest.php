<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\Tests\UnitTests\CurrencyExchange\Domain;

use PHPUnit\Framework\TestCase;
use MJankowski\Recruitment\CurrencyExchange\Domain\Utility\Fee;

final class FeeTest extends TestCase
{
    /**
     * @dataProvider amountProvider
     */
    public function testCalculateForAmount(float $amount, float $expectedFee): void
    {
        $fee = Fee::calculateForAmount($amount);
        $this->assertEquals($expectedFee, $fee);
    }

    public static function amountProvider(): array
    {
        return [
            'Amount greater than the minimum fee, percentage fee' => [200, 2.0],
            'Amount less than the minimum fee, minimum fee applied' => [50, 1.25],
            'Amount close to the minimum fee but still applying the minimum' => [99.99, 1.25],
            'Negative value' => [-100, 1.25],
            'Zero value' => [0, 1.25],
            'Extremely high value' => [PHP_FLOAT_MAX, PHP_FLOAT_MAX * 0.01],
        ];
    }
}
