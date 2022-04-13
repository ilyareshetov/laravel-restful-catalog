<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * @param CategoryRequest $request
     * @return CategoryResource
     */
    public function store(CategoryRequest $request): CategoryResource
    {
        $newCat = Category::create([
            'title' => $request->title
        ]);

        return new CategoryResource($newCat);
    }

    /**
     * @param Category $category
     * @return JsonResponse
     * @throws \Throwable
     */
    public function destroy(Category $category): JsonResponse
    {
        if ($category->products()->count() === 0) {
            $category->deleteOrFail();

            return response()->json([
                'success'   => true,
            ]);
        }

        return response()->json([
            'success'   => false,
            'message'   => 'Category has products'
        ]);
    }
}
