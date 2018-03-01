<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Session;
use App\Http\Controllers\Controller;
use App\Exceptions\CartException;
class CartController extends Controller
{
	public function index() {
		$currentCart = Cart::getCurrentCart();
		return json_encode($currentCart);
	}
	
	public function add(Request $request, $product_id=0, $quantity=0) {
		if($request->getMethod() == 'POST'){
			$product_id = $request->has('product_id') ? $request->input('product_id') : null;
			$quantity = $request->has('quantity') ? $request->input('quantity') : null;
		}
		$errors = null;
		$product = Product::find($product_id);
		if(!$product){
			$errors[] = array('code'=>'required','message'=>'Product cannot be blank.', 'name'=>'product_id');
		}
		if(intval($quantity)<1 || intval($quantity)>9){
			$errors[] = array('code'=>'required','message'=>'Quantity cannot be blank.', 'name'=>'quantity');
		}
		if($errors){
			throw new CartException($errors, 'Invalid data parameters', 400);
		}
		$currentCart = Cart::getCurrentCart();
		$cart = new Cart($currentCart);
		$cart->addItem($product, $quantity);
	}
	
	public function delete(Request $request, $product_id=0) {
		if($request->getMethod() == 'DELETE'){
			$product_id = $request->has('product_id') ? $request->input('product_id') : null;
		}
		$errors = null;
		$product = Product::find($product_id);	
		if(!$product){
			$errors[] = array('code'=>'required','message'=>'Product cannot be blank.', 'name'=>'product_id');
		}
		if($errors){
			throw new CartException($errors, 'Invalid data parameters', 400);
		}
		$currentCart = Cart::getCurrentCart();
		$cart = new Cart($currentCart);
		$cart->deleteItem($product);
	}
}
