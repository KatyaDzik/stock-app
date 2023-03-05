<?php

namespace App\Dto;

/**
 * Class ReceiptOfProductsDto
 * @package App\Dto
 */
class ReceiptOfProductsDto
{
    private int $count, $nds, $product_id;
    private float $price;

    /**
     * @param int $count
     * @param float $price
     * @param int $nds
     * @param int $product_id
     */
    public function __construct(int $count, float $price, int $nds, int $product_id)
    {
        $this->count = $count;
        $this->price = $price;
        $this->nds = $nds;
        $this->product_id = $product_id;
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
        return $this->product_id;
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
}
