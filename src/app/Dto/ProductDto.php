<?php

namespace App\Dto;

class ProductDto
{
    private string $name;
    private string $sku;
    private int $category_id;
    private int $author_id;

    /**
     * @param string $name
     * @param string $sku
     * @param int $category_id
     * @param int $author_id
     */
    public function __construct(string $name, string $sku, int $category_id, int $author_id)
    {
        $this->name = $name;
        $this->sku = $sku;
        $this->category_id = $category_id;
        $this->author_id = $author_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
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
