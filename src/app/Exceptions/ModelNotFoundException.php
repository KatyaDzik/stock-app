<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class ModelNotFoundException
 * @package App\Exceptions
 */
final class ModelNotFoundException extends HttpException
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json([
            'error' => $this->getMessage()
        ], $this->getStatusCode());
    }
}
