<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoveCategoryRequest;
use App\Http\Requests\SortCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Service\CategoryService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::query()->parents()->with(['products','categories'])->get();

        return CategoryResource::collection($categories);
    }

    public function sort(SortCategoryRequest $request, Category $category, CategoryService $service)
    {
        return $service->changeSort($category,  $request->validated('sort_number'), Category::find($category->category_id));
    }

    public function move(MoveCategoryRequest $request, Category $category, CategoryService $service)
    {
        return $service->moveCategory($category, Category::find($request->validated('category_id')));
    }
}
