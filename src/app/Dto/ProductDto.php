<?php

namespace App\Dto;

class ProductDto
{
    private string $product;
    private int $category_id;
    private int $author_id;

    /**
     * @param string $product
     * @param int $category_id
     * @param int $author_id
     */
    public function __construct(string $product, int $category_id, int $author_id)
    {
        $this->product = $product;
        $this->category_id = $category_id;
        $this->author_id = $author_id;
    }

    /**
     * @return string
     */
    public function getProduct(): string
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return $this->category_id;
    }

    /**
     * @return int
     */
    public function getAuthor(): int
    {
        return $this->author_id;
    }

}
