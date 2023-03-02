<?php

namespace App\Dto;

/**
 * Class CustomerDto
 * @package App\Dto
 */
class CustomerDto
{
    private string $name;
    private int $author_id;

    /**
     * @param string $name
     * @param int $author_id
     */
    public function __construct(string $name, int $author_id)
    {
        $this->name = $name;
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
     * @return int
     */
    public function getAuthor(): int
    {
        return $this->author_id;
    }
}
