<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\ProviderRepository;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $repo = new InvoiceRepository();
        dump($repo->getInvoicesByCustomer(1));
    }
}
