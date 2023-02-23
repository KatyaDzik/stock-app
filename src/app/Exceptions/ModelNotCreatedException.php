<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class UserNotCreatedException
 * @package App\Exceptions
 */
final class ModelNotCreatedException extends HttpException
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
