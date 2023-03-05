<?php

namespace App\Dto;

/**
 * Class ProductInStockDto
 * @package App\Dto
 */
class ProductInStockDto
{
    private int $count, $product_id, $stock_id, $nds;
    private float $price;

    /**
     * @param int $count
     * @param float $price
     * @param int $nds
     * @param int $product_id
     * @param int $stock_id
     */
    public function __construct(int $count, float $price, int $nds, int $product_id, int $stock_id)
    {
        $this->count = $count;
        $this->price = $price;
        $this->nds = $nds;
        $this->product_id = $product_id;
        $this->stock_id = $stock_id;
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
    public function getStock(): int
    {
        return $this->stock_id;
    }
}
