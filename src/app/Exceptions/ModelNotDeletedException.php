<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class ModelNotDeletedException
 * @package App\Exceptions
 */
final class ModelNotDeletedException extends RenderedHttpException
{
    /**
     * @param null|string $message
     * @param \Throwable|null $previous
     * @param array $headers
     * @param null|int $code
     */
    public function __construct(
        ?string $message = 'Не удалось удалить',
        \Throwable $previous = null,
        array $headers = [],
        ?int $code = 0
    ) {
        parent::__construct(Response::HTTP_BAD_REQUEST, $message, $previous, $headers, $code);
    }
}
