<?php

namespace App\Dto;

final class CategoryDto
{
    private $category;
    private $parent_id;


    /**
     * @param string $category
     * @param int|null $parent_id
     */
    public function __construct(string $category, ?int $parent_id)
    {
        $this->category = $category;
        $this->parent_id = $parent_id;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return int|null
     */
    public function getParent(): ?int
    {
        return $this->parent_id;
    }
}
