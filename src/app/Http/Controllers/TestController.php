<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;

class TestController extends Controller
{
    public function index()
    {
        $repository = new CategoryRepository();
        //echo('hiii');
        dd($repository->all());
    }
}
