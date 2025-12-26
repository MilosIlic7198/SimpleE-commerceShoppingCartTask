<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        // Fetch the cart products that the user already has in their cart
        $cartItems = Auth::user()
            ->cartItems()
            ->select('id', 'product_id', 'quantity')
            ->with('product')
            ->get();
        // Pass cart products to the frontend
        return Inertia::render('cart/Index', [
            'cartItems' => $cartItems,
        ]);
    }

    public function store(Request $request, Product $product)
    {
        // Ensure that the user hasn't already added the product to the cart
        $existingCartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingCartItem) {
            // If the product already exists in the cart, simply return
            return;
        }

        // If not in cart, create a new cart item
        $cartItem = CartItem::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => 1,  // Add 1 quantity by default
        ]);
    }


    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        if ($cartItem->product->stock_quantity < $request->quantity) {
            // No more in stock
            return;
        }

        $cartItem->update(['quantity' => $request->quantity]);
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
    }

}

