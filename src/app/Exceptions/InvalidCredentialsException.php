<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class InvalidCredentialsException
 * @package App\Exceptions
 */
final class InvalidCredentialsException extends HttpException
{
    /**
     * @param null|string $message
     * @param \Throwable|null $previous
     * @param array $headers
     * @param null|int $code
     */
    public function __construct(
        ?string $message = 'Неправильный логин или пароль',
        \Throwable $previous = null,
        array $headers = [],
        ?int $code = 0
    ) {
        parent::__construct(Response::HTTP_BAD_REQUEST, $message, $previous, $headers, $code);
    }

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => $this->getMessage()
        ], $this->getStatusCode());
    }
}
