<?php

namespace App\Providers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('vendor.pagination.bootstrap-4');

        Gate::define('add products to invoice', function (User $user, Invoice $invoice) {
            return $invoice->status->id === config('status-enums.statuses')['PACKED'];
        });

        Gate::define('incoming invoice', function (User $user, Invoice $invoice) {
            return $invoice->type->id === config('type-enums.types')['INCOMING'];
        });

        Gate::define('outcoming invoice', function (User $user, Invoice $invoice) {
            return $invoice->type->id === config('type-enums.types')['OUTCOMING'];
        });
    }
}
