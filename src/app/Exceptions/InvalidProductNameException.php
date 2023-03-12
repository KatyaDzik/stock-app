<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidProductNameException extends RenderedHttpException
{
    public function __construct(
        ?string $message = 'У данного поставщика уже есть в наличии такой товар',
        \Throwable $previous = null,
        array $headers = [],
        ?int $code = 0
    ) {
        parent::__construct(Response::HTTP_BAD_REQUEST, $message, $previous, $headers, $code);
    }
}
