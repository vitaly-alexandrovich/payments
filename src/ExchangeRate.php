<?php namespace payments;

use payments\exceptions\CurrencyRateException;

/**
 * Class ExchangeRate
 * @package payments
 */
class ExchangeRate
{
    public array $currencyRates = [];

    /**
     * @param string $fromCurrency
     * @param string $toCurrency
     * @param float $rate
     */
    public function addCurrencyRate(string $fromCurrency, string $toCurrency, float $rate)
    {
        if (!isset($this->currencyRates[$fromCurrency])) {
            $this->currencyRates[$fromCurrency] = [];
        }

        $this->currencyRates[$fromCurrency][$toCurrency] = $rate;
    }

    /**
     * @param $fromCurrency
     * @param $toCurrency
     * @return bool
     */
    public function isSupportedCurrencyRate($fromCurrency, $toCurrency)
    {
        return isset($this->currencyRates[$fromCurrency], $this->currencyRates[$fromCurrency][$toCurrency]);
    }

    /**
     * @param $fromCurrency
     * @param string $toCurrency
     * @return void
     * @throws CurrencyRateException
     */
    public function getCurrencyRate($fromCurrency, $toCurrency)
    {
        if (!$this->isSupportedCurrencyRate($fromCurrency, $toCurrency)) {
            throw new CurrencyRateException("Exchange currency rate ${fromCurrency} -> ${toCurrency} is not supported");
        }

        return $this->currencyRates[$fromCurrency][$toCurrency];
    }
}
