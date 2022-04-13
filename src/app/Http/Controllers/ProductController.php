<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductsListRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * @param ProductRequest $request
     * @return ProductResource
     */
    public function store(ProductRequest $request): ProductResource
    {
        $newProd = Product::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'published'     => $request->published,
        ]);

        $newProd->categories()->attach($request->categories);

        return new ProductResource($newProd);
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return ProductResource
     */
    public function update(ProductRequest $request, Product $product): ProductResource
    {
        $product->title         = $request->title;
        $product->description   = $request->description;
        $product->price         = $request->price;
        $product->published     = $request->published;
        $product->save();

        $product->categories()->sync($request->categories);

        return new ProductResource($product);
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'success'   => true,
        ]);
    }

    /**
     * @param ProductsListRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ProductsListRequest $request)
    {
        if ($request->deleted == 1) {
            $products = Product::onlyTrashed();
        } else {
            $products = Product::query();
        }

        if ($request->category_id !== null) {
            $products = $products->whereHas('categories', function ($q) use ($request) {
                $q->whereId($request->category_id);
            });
        }

        if ($request->category !== null) {
            $products = $products->whereHas('categories', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->category . '%');
            });
        }

        $products = $products->where($request->getFilter());

        return ProductResource::collection($products->get());
    }
}
