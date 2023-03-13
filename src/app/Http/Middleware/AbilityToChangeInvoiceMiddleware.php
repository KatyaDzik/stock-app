<?php

namespace App\Http\Middleware;

use App\Enums\StatusEnums;
use App\Repositories\InvoiceRepository;
use Closure;
use Illuminate\Http\Request;

class AbilityToChangeInvoiceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $invoice_repository = new InvoiceRepository();
        $invoice = $invoice_repository->getById($request->route('invoice'));

        if ($invoice->status_id === StatusEnums::PACKED) {
            return $next($request);
        }

        abort(403);
    }
}
