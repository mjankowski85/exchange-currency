<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\Tests\UnitTests\CurrencyExchange\Domain;

use PHPUnit\Framework\TestCase;
use MJankowski\Recruitment\CurrencyExchange\Domain\Model\Currency;

final class CurrencyTest extends TestCase
{
    public function testCurrencyCodeIsCorrectlySetAndRetrieved(): void
    {
        $code = 'EUR';
        $currency = new Currency($code);

        $this->assertSame($code, $currency->getCode());
    }
}
