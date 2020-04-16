<?php namespace payments\interfaces;

/**
 * Interface CustomerInterface
 * @package payments\interfaces
 */
interface CustomerInterface
{
    /**
     * Возвращет полное имя покупателя
     * @return string
     */
    public function getFullName(): ?string;

    /**
     * Возвращет email покупателя
     * @return string
     */
    public function getEmail(): ?string;

    /**
     * Возвращет номер телефона покупателя
     * @return string
     */
    public function getPhone(): ?string;
}
