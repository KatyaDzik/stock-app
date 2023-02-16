<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OrganizationChanges;
use App\Repositories\CategoryRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\OrganizationChangesRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProviderRepository;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $repo = new ProductRepository();
        dump($repo->getProductsByStock(2));
    }
}
