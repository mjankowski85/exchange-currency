<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\CurrencyExchange\Domain\Exception;

use RuntimeException;

class UnsupportedCurrencyException extends RuntimeException
{
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
