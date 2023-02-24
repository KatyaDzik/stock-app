<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class LogoutException
 * @package App\Exceptions
 */
final class LogoutException extends RenderedHttpException
{
    /**
     * @param null|string $message
     * @param \Throwable|null $previous
     * @param array $headers
     * @param null|int $code
     */
    public function __construct(
        ?string $message = 'Не удалось создать пользователя',
        \Throwable $previous = null,
        array $headers = [],
        ?int $code = 0
    ) {
        parent::__construct(Response::HTTP_UNAUTHORIZED, $message, $previous, $headers, $code);
    }
}
