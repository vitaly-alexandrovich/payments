<?php namespace payments\interfaces;

use payments\Amount;

/**
 * Interface OrderItemInterface
 * @package payments\interfaces
 */
interface OrderItemInterface
{
    /**
     * Возвращает название товара (или услуги)
     * @return string
     */
    public function getTitle(): ?string;

    /**
     * Возвращает описание товара (или услуги)
     * @return null|string
     */
    public function getDescription(): ?string;

    /**
     * Возвращает стоимость товара (или услуги)
     * @return Amount
     */
    public function getAmount(): Amount;

    /**
     * Возвращает количество товаров (или услуг) данной позиции в заказе
     * @return int
     */
    public function getQuantity(): int;
}
