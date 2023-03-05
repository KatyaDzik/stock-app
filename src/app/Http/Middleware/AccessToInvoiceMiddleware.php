<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccessToInvoiceMiddleware
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
        $user = $request->user();

        if ($user->permissions->containsStrict('name', 'admin-panel') ||
            $user->permissions->containsStrict('name', 'actions on invoices')) {

            return $next($request);
        }

        abort(403);
    }
}
