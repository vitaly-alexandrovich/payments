<?php namespace payments;

use payments\exceptions\CurrencyRateException;

/**
 * Class Amount
 */
class Amount
{
    private float $value;
    private string $currency;

    /**
     * Amount constructor.
     * @param float $value
     * @param string $currency
     */
    public function __construct(float $value, string $currency = Currency::RUB)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param $currency
     * @param ExchangeRate $exchangeRate
     * @return Amount
     * @throws CurrencyRateException
     */
    public function exchangeTo($currency, ExchangeRate $exchangeRate): Amount
    {
        return Currency::exchange($this, $currency, $exchangeRate);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return strval($this->getValue());
    }
}
