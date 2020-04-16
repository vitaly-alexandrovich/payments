<?php namespace payments;

use payments\discount\AmountDiscount;
use payments\discount\PercentDiscount;
use payments\exceptions\OrderCurrencyException;
use payments\interfaces\DiscountInterface;
use payments\interfaces\OrderInterface;
use payments\interfaces\OrderItemInterface;

/**
 * Class AbstractOrder
 * @package payments
 */
abstract class AbstractOrder implements OrderInterface
{
    private array $items = [];
    private ?string $currency = null;
    private ?DiscountInterface $discount = null;

    /**
     * @inheritDoc
     */
    public function getAmount(): Amount
    {
        $amount = 0;

        foreach ($this->getItems() as $item) {
            $amount += $item->getAmount()->getValue() * $item->getQuantity();
        }

        return new Amount($amount);
    }

    /**
     * @return float|int
     */
    public function getTotalAmount(): float
    {
        return $this->getAmount()->getValue() - $this->getDiscountValue();
    }

    /**
     * @return float|int
     */
    public function getDiscountValue(): float
    {
        return static::calculateDiscountValue($this->getAmount(), $this->getDiscount());
    }

    /**
     * @param Amount $amount
     * @param DiscountInterface $discount
     * @return float|int
     */
    protected static function calculateDiscountValue(Amount $amount, ?DiscountInterface $discount): float
    {
        if (is_null($discount)) {
            return 0.0;
        }

        $discountValue = 0.0;

        if ($discount instanceof AmountDiscount) {
            $discountValue = $discount->getValue();
        } else if ($discount instanceof PercentDiscount) {
            $discountValue = $amount->getValue() * $discount->getValue() / 100;
        }

        if (is_numeric($discount->getNotLessValue()) && $discountValue < $discount->getNotLessValue()) {
            $discountValue = $discount->getNotLessValue();
        }

        if (is_numeric($discount->getNotMoreValue()) && $discountValue > $discount->getNotMoreValue()) {
            $discountValue = $discount->getNotMoreValue();
        }

        if ($discountValue > $amount->getValue()) {
            return $amount->getValue();
        }

        return $discountValue;
    }

    /**
     * @inheritDoc
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     * @throws OrderCurrencyException
     */
    public function addItem(OrderItemInterface $item): void
    {
        if (!is_null($this->currency) && $this->currency !== $item->getAmount()->getCurrency()) {
            throw new OrderCurrencyException('Order currency is different from order currency');
        }

        $this->items[] = $item;
        return;
    }

    /**
     * @param DiscountInterface $discount
     */
    public function setDiscount(DiscountInterface $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return DiscountInterface
     */
    public function getDiscount(): ?DiscountInterface
    {
        return $this->discount;
    }
}
