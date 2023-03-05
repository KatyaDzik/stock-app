<?php

namespace App\Dto;

/**
 * Class StockDto
 * @package App\Dto
 */
class StockDto
{
    private string $name;
    private string $address;

    /**
     * @param string $name
     * @param string $address
     */
    public function __construct(string $name, string $address)
    {
        $this->name = $name;
        $this->address = $address;
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
    public function getAddress(): string
    {
        return $this->address;
    }
}
