<?php namespace payments\interfaces;

/**s
 * Interface DiscountInterface
 * @package payments\interfaces
 */
interface DiscountInterface
{
    /**
     * @return float
     */
    public function getValue(): float;
}
