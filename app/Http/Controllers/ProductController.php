<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('checkPermission:read_product', only: ['index', 'show']),
            new Middleware('checkPermission:create_product,update_product,delete_product', only: ['store', 'update', 'delete']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        // Create a new user instance
        $product = new Product();

        // Fill the user instance with validated data
        $product->fill([
            'sku' => 'pr_' . Str::uuid(),
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'quantity' => $request['quantity'],
        ]);

        // Save the user to the database
        $product->save();

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the user by ID
        $product = $this->get_product($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        // Find the user by ID
        $product = $this->get_product($id);

        // Update only the fields present in the request
        $product->update($request->all());

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Product updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the user by ID
        $product = $this->get_product($id);

        // Delete the user
        $product->delete();

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Product deleted successfully']);
    }


    protected function get_product($id)
    {
        // Find the user by ID
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return $product;
    }
}
