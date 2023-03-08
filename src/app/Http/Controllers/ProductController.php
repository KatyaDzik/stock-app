<?php

namespace App\Http\Controllers;

use App\Dto\ProductDto;
use App\Http\Requests\ProductRequest;
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
        $data = new ProductDto(
            $request->input('name'),
            md5('new'),
            $request->input('category_id'),
            auth('web')->user()->id
        );

        $this->service->create($data);
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
     * @param ProductRequest $request
     * @return void
     */
    public function update(int $id, ProductRequest $request): void
    {
        $data = new ProductDto(
            $request->input('name'),
            $request->input('category_id'),
            $request->input('scu'),
            auth('web')->user()->id
        );

        $this->service->update($id, $data);
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
