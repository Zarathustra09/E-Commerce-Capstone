<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index');
    }

    public function dataTable()
    {
        $products = Product::with('category')->get();
        return response()->json(['data' => $products]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image'
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images', 'public');
            }
            $product = Product::create($data);
            return response()->json(['message' => 'Product has been added.', 'data' => $product], 201);
        } catch (\Exception $e) {
            Log::error('Error adding product: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while adding the product.'], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $product = Product::with('category')->find($id);
            return response()->json(['data' => $product]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the product.'], 500);
        }
    }

    public function edit(string $id)
    {
        try {
            $product = Product::find($id);
            return response()->json(['data' => $product]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while editing the product.'], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $product = Product::find($id);
            $product->update($request->all());

            return response()->json(['message' => 'Product has been updated.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating the product.'], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);
            $product->delete();

            return response()->json(['message' => 'Product has been deleted.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the product.'], 500);
        }
    }

    public function getCategories()
    {
        try {
            $categories = Category::all();
            return response()->json(['data' => $categories]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while fetching categories.'], 500);
        }
    }
}
