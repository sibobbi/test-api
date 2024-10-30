<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoveCategoryRequest;
use App\Http\Requests\SortCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Service\CategoryService;

class ProductController extends Controller
{
    public function sort(SortCategoryRequest $request, Product $product, CategoryService $service)
    {
        $product = $service->changeSort($product,  $request->validated('sort_number'), Category::find($product->category->id));

        return $product;
    }
    public function move(MoveCategoryRequest $request, Product $product, CategoryService $service)
    {
        return $service->moveCategory($product, Category::find($request->validated('category_id')));
    }
}
