<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class RenderedHttpException
 * @package App\Exceptions
 */
class RenderedHttpException extends HttpException
{
    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            "errors" => (object)['error' => [$this->getMessage()]]
        ], $this->getStatusCode());
    }
}
