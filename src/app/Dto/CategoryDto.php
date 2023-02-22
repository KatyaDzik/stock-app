<?php

namespace App\Dto;

final class CategoryDto
{
    private string $name;
    private ?int $parent_id;


    /**
     * @param string $name
     * @param int|null $parent_id
     */
    public function __construct(string $name, ?int $parent_id)
    {
        $this->name = $name;
        $this->parent_id = $parent_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getParent(): ?int
    {
        return $this->parent_id;
    }
}
