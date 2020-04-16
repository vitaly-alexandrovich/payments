<?php namespace payments;


use payments\exceptions\CurrencyRateException;

/**
 * Class Currency
 * @package payments
 */
class Currency {
    const RUB = 'RUB';
    const USD = 'USD';

    /**
     * @param Amount $amount
     * @param string $toCurrency
     * @param ExchangeRate $exchangeRate
     * @return Amount
     * @throws CurrencyRateException
     */
    public static function exchange(Amount $amount, string $toCurrency, ExchangeRate $exchangeRate): Amount {
        return new Amount(
            $amount->getValue() * $exchangeRate->getCurrencyRate($amount->getCurrency(), $toCurrency),
            $toCurrency
        );
    }
}
