<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Services\ProductService;
use Illuminate\View\View;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    private ProductService $service;

    /**
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ProductRequest $request
     * @return void
     */
    public function store(ProductRequest $request): void
    {
        $this->service->create($request->validated());
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $product = $this->service->read($id);

        return view('user/product-profile', compact('product'));
    }

    /**
     * @param int $id
     * @param ProductUpdateRequest $request
     * @return void
     */
    public function update(int $id, ProductUpdateRequest $request): void
    {
        $this->service->update($id, $request->validated());
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function destroy(int $id): void
    {
        $this->service->delete($id);
    }

    /**
     * @return View
     */
    public function getAll(): View
    {
        $products = $this->service->getAllPaginate(5);

        return view('user/products', compact('products'));
    }
}
