<?php

namespace App\Service;

use App\Http\Requests\MoveCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Exception;

class CategoryService
{
    public function changeSort(Product|Category $model,int $sortNumber, Category $parentCategory){

        if ($model instanceof Category){
            if ($model->id === $parentCategory->id) {
                throw new Exception('Категории совпадают');
            }
            $sortElement = Category::query()->where('category_id', $parentCategory->id)->where('sort_number',$sortNumber)->first();
        }

        if ($model instanceof Product) {
            $sortElement = Product::query()->where('category_id', $parentCategory->id)->where('sort_number',$sortNumber)->first();
        }

        if ($sortElement) {

            $oldSortNumber = $model->sort_number;

            $model->update(['sort_number' => $sortNumber]);
            $sortElement->update(['sort_number' => $oldSortNumber]);

        } else {
            $model->update(['sort_number' => $sortNumber, 'category_id' => $parentCategory->id]);
        }

        return $model;
    }

    public function moveCategory(Product|Category $model, Category $parentCategory)
    {
        if ($model instanceof Category) {
            if (($parentCategory->getCountExpand() + $model->getCountExpand()) > Category::MAX_CATEGORY_LEVEL) {
                throw new Exception('Нельзя создавать более ' . Category::MAX_CATEGORY_LEVEL . ' уровней вложенности');
            }

            $newSortNumber = $this->getLastSortNumberCategory($parentCategory) + 1;
        }

        if ($model instanceof Product) {
            $newSortNumber = $this->getLastSortNumberProduct($parentCategory) + 1;
        }

        $model->update(['category_id' => $parentCategory->id,'sort_number' => $newSortNumber]);

        return $model;
    }

    public function getLastSortNumberCategory(Category $parentCategory): int
    {
        $maxSortNumber = Category::query()->where('category_id',$parentCategory->id)->orderBy('sort_number', 'desc')->first();

        if ($maxSortNumber) {
            return $maxSortNumber->sort_number;
        }

        return 0;
    }
    public function getLastSortNumberProduct(Category $parentCategory): int
    {
        $maxSortNumber = Product::query()->where('category_id',$parentCategory->id)->orderBy('sort_number', 'desc')->first();

        if ($maxSortNumber) {
            return $maxSortNumber->sort_number;
        }

        return 0;
    }
}
