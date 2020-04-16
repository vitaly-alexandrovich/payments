<?php namespace payments\discount;

use payments\interfaces\DiscountInterface;

/**
 * Class AbstractDiscount
 * @package payments\discount
 */
abstract class AbstractDiscount implements DiscountInterface
{
    private float $value;
    private ?float $notLess = null;
    private ?float $notMore = null;

    /**
     * PercentDiscount constructor.
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return AbstractDiscount
     */
    public function butNotLess(float $value): self
    {
        $this->notLess = $value;
        return $this;
    }

    /**
     * @param float $value
     * @return AbstractDiscount
     */
    public function butNotMore(float $value): self
    {
        $this->notMore = $value;
        return $this;
    }

    /**
     * @return float
     */
    public function getNotLessValue(): ?float
    {
        return $this->notLess;
    }

    /**
     * @return float
     */
    public function getNotMoreValue(): ?float
    {
        return $this->notMore;
    }
}
