<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\Tests\UnitTest\CurrencyExchange\Domain;

use PHPUnit\Framework\TestCase;
use MJankowski\Recruitment\Shop\Domain\Name;
use MJankowski\Recruitment\Shop\Domain\Exceptions\NameIsTooShortException;

final class CurrencyExchangeServiceTest extends TestCase
{
    public function testBuy100(): void
    {
        $name = 'Walmart';

        $SUT = Name::create($name);

        self::assertEquals($name, $SUT->value);
    }

}
