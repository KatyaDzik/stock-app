<?php

namespace App\Dto;

/**
 * Class ProductToInvoiceDto
 * @package App\Dto
 */
class ProductHasInvoiceDto
{
    private int $count, $product_id, $invoice_id, $nds;
    private float $price;

    /**
     * @param int $count
     * @param float $price
     * @param int $nds
     * @param int $product_id
     * @param int $invoice_id
     */
    public function __construct(int $count, float $price, int $nds, int $product_id, int $invoice_id)
    {
        $this->count = $count;
        $this->price = $price;
        $this->nds = $nds;
        $this->product_id = $product_id;
        $this->invoice_id = $invoice_id;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getNds(): int
    {
        return $this->nds;
    }

    /**
     * @return int
     */
    public function getProduct(): int
    {
        return $this->product_id;
    }

    /**
     * @return int
     */
    public function getInvoice(): int
    {
        return $this->invoice_id;
    }

    /**
     * @param int $count
     * @return void
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
    }
}
