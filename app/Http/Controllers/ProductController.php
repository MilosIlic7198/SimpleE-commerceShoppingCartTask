<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all products
        $products = Product::all();

        // Fetch the product IDs that the user already has in their cart
        $cartProducts = Auth::user()->cartItems()->pluck('product_id')->toArray();

        // Pass products and cart product IDs to the frontend
        return Inertia::render('products/Index', [
            'products' => $products,
            'cartProducts' => $cartProducts,  // Send only the product IDs
        ]);
    }
}

