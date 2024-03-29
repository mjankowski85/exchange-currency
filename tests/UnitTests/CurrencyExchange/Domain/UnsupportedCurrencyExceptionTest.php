<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\Tests\UnitTests\CurrencyExchange\Domain;

use PHPUnit\Framework\TestCase;
use MJankowski\Recruitment\CurrencyExchange\Domain\Exception\UnsupportedCurrencyException;

final class UnsupportedCurrencyExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        $exception = new UnsupportedCurrencyException('Test message');
        $this->assertSame('Test message', $exception->getMessage());
    }

    public function testExceptionCodeIsZeroByDefault(): void
    {
        $exception = new UnsupportedCurrencyException('Test');
        $this->assertSame(0, $exception->getCode());
    }

    public function testExceptionWithCustomCode(): void
    {
        $exception = new UnsupportedCurrencyException('Test', 1);
        $this->assertSame(1, $exception->getCode());

        $exception = new UnsupportedCurrencyException('Test', -1);
        $this->assertSame(-1, $exception->getCode());
    }

    public function testExceptionConstructCallsParent(): void
    {
        $previous = new \RuntimeException();
        $exception = new UnsupportedCurrencyException('Test', 0, $previous);
        $this->assertSame($previous, $exception->getPrevious());
    }
}
