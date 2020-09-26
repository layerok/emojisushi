<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreProductFormRequest;
use App\Models\Product;

class ProductController extends BaseController
{


    protected $categoryRepository;

    protected $productRepository;

    public function __construct(
        CategoryContract $categoryRepository,
        ProductContract $productRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = Product::with('categories')->get();
        $this->setPageTitle('Продукты', 'Список продуктов');
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->listCategories('name', 'asc');

        $this->setPageTitle('Продукты', 'Создать продукт');
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductFormRequest $request)
    {
        $params = $request->except('_token');

        $product = $this->productRepository->createProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while creating product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Product added successfully' ,'success',false, false);
    }

    public function edit($id)
    {
        $product = $this->productRepository->findProductById($id);
        $categories = $this->categoryRepository->listCategories('name', 'asc');


        $this->setPageTitle('Продукты', 'Редактировать продукт');
        return view('admin.products.edit', compact('categories', 'product'));
    }

    public function update(StoreProductFormRequest $request)
    {
        $params = $request->except('_token');

        $product = $this->productRepository->updateProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while updating product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Product updated successfully' ,'success',false, false);
    }
}
