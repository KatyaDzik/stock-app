<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;


class TestController extends Controller
{
    public function index()
    {
        $repo = new CategoryRepository();
        dump($repo->getSubcategories(1));
    }
}
