<?php

namespace App\Dto;

/**
 * Class InvoiceDto
 * @package App\Dto
 */
class InvoiceDto
{
    private string $number, $date, $from, $to;
    private int $provider_id, $customer_id, $type_id, $status_id;

    /**
     * @param string $number
     * @param string $date
     * @param string $from
     * @param string $to
     * @param int $provider_id
     * @param int $customer_id
     * @param int $type_id
     * @param int $status_id
     */
    public function __construct(string $number, string $date, string $from, string $to,
        int $provider_id, int $customer_id, int $type_id, int $status_id)
    {
        $this->number = $number;
        $this->date = $date;
        $this->from = $from;
        $this->to = $to;
        $this->provider_id = $provider_id;
        $this->customer_id = $customer_id;
        $this->type_id = $type_id;
        $this->status_id = $status_id;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return int
     */
    public function getProvider(): int
    {
        return $this->provider_id;
    }

    /**
     * @return int
     */
    public function getCustomer(): int
    {
        return $this->customer_id;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type_id;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status_id;
    }
}