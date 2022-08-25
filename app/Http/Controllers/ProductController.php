<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  public function index(Product $product)
  {
    $products = Product::all();
    return view('product.index', compact('products'));
  }

  public function show(Product $product)
  {
    return view('product.show', compact('product'));
  }

  public function search(Request $request)
  {
    $products = Product::where('name', 'like', '%' . $request->search . '%')->get();
    return view('product.search', compact('products'));
  }

  public function addToCart(Request $request)
  {
    $product = Product::find($request->product_id);
    $user = auth()->user();
    $quantity = $request->quantity;

    $cart = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();
    if ($cart) {
      $cart->quantity += $quantity;
      $cart->save();
    }
    else {
      Cart::create([
        'user_id' => $user->id,
        'product_id' => $product->id,
        'quantity' => $quantity
      ]);
    }
    return redirect()->route('product.show', $product->id)->with('success', 'Product added to cart successfully');
  }

  static public function getCartItems()
  {
    $user = auth()->user();
    $carts = Cart::where('user_id', $user->id)->get();
    $cart_items = [];
    foreach ($carts as $cart) {
      $cart_items[] = [
        'product' => $cart->product,
        'quantity' => $cart->quantity
      ];
    }
    $total_items = 0;

    foreach ($cart_items as $cart_item) {
      $total_items += $cart_item['quantity'];
    }
    return $total_items;
  }


  public function cartIndex()
  {
    $user = auth()->user();
    $products = DB::table('carts')
      ->join('products', 'carts.product_id', '=', 'products.id')
      ->where('carts.user_id', $user->id)
      ->select('products.*', 'carts.quantity', 'carts.id as cart_id')
      ->get();

    $totalPrice = 0;
    foreach ($products as $product) {
      $totalPrice += $product->price * $product->quantity;
    }

    return view('cart.index', compact('products', 'totalPrice'));
  }

  public function cartDestroy(Request $request)
  {
    $cart = Cart::find($request->id);
    $cart->delete();
    return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully');
  }

}
