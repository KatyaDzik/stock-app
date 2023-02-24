<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class ModelNotFoundException
 * @package App\Exceptions
 */
final class ModelNotFoundException extends RenderedHttpException
{
    /**
     * @param null|string $message
     * @param \Throwable|null $previous
     * @param array $headers
     * @param null|int $code
     */
    public function __construct(
        ?string $message = 'Не удалось найти :(',
        \Throwable $previous = null,
        array $headers = [],
        ?int $code = 0
    ) {
        parent::__construct(Response::HTTP_NOT_FOUND, $message, $previous, $headers, $code);
    }
}
