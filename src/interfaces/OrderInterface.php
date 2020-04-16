<?php namespace payments\interfaces;

use payments\Amount;

/**
 * Interface OrderInterface
 * @package payments\interfaces
 */
interface OrderInterface
{
    /**
     * Добавляет новый товар (или услугу) в заказх
     * @param OrderItemInterface $item
     */
    public function addItem(OrderItemInterface $item): void;

    /**
     * Возвращает список товаров (или услуг) в заказе
     * @return OrderItemInterface[]
     */
    public function getItems(): ?array;

    /**
     * Возвращает информацию о покупателе
     * @return CustomerInterface
     */
    public function getCustomer(): ?CustomerInterface;

    /**
     * Возвращает общую стоимость заказа
     * @return Amount
     */
    public function getAmount(): Amount;

    /**
     * @param DiscountInterface $discount
     */
    public function setDiscount(DiscountInterface $discount): void;
}
