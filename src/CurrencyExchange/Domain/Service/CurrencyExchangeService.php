<?php

declare(strict_types=1);

namespace MJankowski\Recruitment\CurrencyExchange\Domain\Service;

use MJankowski\Recruitment\CurrencyExchange\Domain\Model\Money;
use MJankowski\Recruitment\CurrencyExchange\Domain\Utility\Fee;
use MJankowski\Recruitment\CurrencyExchange\Domain\Model\Currency;
use MJankowski\Recruitment\CurrencyExchange\Domain\Interface\CurrencyExchangeRateRepositoryInterface;

final readonly class CurrencyExchangeService
{
    public function __construct(
        private CurrencyExchangeRateRepositoryInterface $exchangeRateRepository
    ) {
    }

    public function buyMoney(Money $moneyToBuy, Currency $currencyToPay): Money
    {
        $exchangeRate = $this->exchangeRateRepository->getRateFor($currencyToPay, $moneyToBuy->getCurrency());
        $amountToPay = $moneyToBuy->getAmount() / $exchangeRate;
        $finalAmount = $amountToPay + Fee::calculateForAmount($amountToPay);
        return new Money($finalAmount, $currencyToPay);
    }

    public function sellMoney(Money $moneyToSell, Currency $currencyToGet): Money
    {
        $exchangeRate = $this->exchangeRateRepository->getRateFor($moneyToSell->getCurrency(), $currencyToGet);
        $exchangedAmount = $moneyToSell->getAmount() * $exchangeRate;
        $finalAmount = $exchangedAmount - Fee::calculateForAmount($exchangedAmount);
        return new Money($finalAmount, $currencyToGet);
    }
}
