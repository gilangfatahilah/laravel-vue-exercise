<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = auth()->user()
            ->products()
            ->with('category')
            ->where(function ($query) {
                if ($search = request()->search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('category', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                }
            })
            ->when(!request()->query('sort_by'), function ($query) {
                $query->latest();
            })
            ->when(in_array(request()->query('sort_by'), ["name", "price", "weight"]), function ($query) {
                $sortBy = request()->query('sort_by');
                $field = ltrim($sortBy, '-');
                $direction = substr($sortBy, 0, 1) === '-' ? 'desc' : 'asc';
                $query->orderBy($field, $direction);
            })
            ->paginate(10)
            ->withQueryString();

        return inertia('Product/Index', [
            'products' => ProductResource::collection($products),
            'query' => (object) request()->query()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Product/Create', [
            "categories" => CategoryResource::collection(Category::orderBy("name")->get()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $request->user()->products()->create($request->validated());

        return redirect()->route("products.index")->with("message", "New product created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render("Product/Show", [
            'product' => ProductResource::make($product),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/Edit', [
            "categories" => CategoryResource::collection(Category::orderBy('name')->get()),
            "product" => ProductResource::make($product),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()->route("products.index")->with("message", "Product updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route("products.index")->with("message", "Product deleted successfully");
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'integer|exists:products,id',
        ]);

        $productIds = $request->input('product_ids');
        Product::whereIn('id', $productIds)->delete();

        return redirect()->route("products.index")->with("message", "Several product deleted successfully");
    }
}
