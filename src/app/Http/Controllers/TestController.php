<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\ProviderRepository;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $repo = new CategoryRepository();
        dump($repo->getSubcategories(2));
    }
}
