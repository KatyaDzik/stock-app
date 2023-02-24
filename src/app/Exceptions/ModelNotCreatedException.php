<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserNotCreatedException
 * @package App\Exceptions
 */
final class ModelNotCreatedException extends RenderedHttpException
{
    /**
     * @param string|null $message
     * @param \Throwable|null $previous
     * @param array $headers
     * @param null|int $code
     */

    public function __construct(
        ?string $message = 'Не удалось создать',
        \Throwable $previous = null,
        array $headers = [],
        ?int $code = 0
    ) {
        parent::__construct(Response::HTTP_BAD_REQUEST, $message, $previous, $headers, $code);
    }
}
