<?php

namespace App;

//use Illuminate\Http\Request;
use Session;

class Cart
{
	public $products = null;
	public $products_count = 0;
	public $total_sum = 0;

	public function __construct($currentCart){
		if($currentCart){
			$this->products = $currentCart->products;
			$this->products_count = $currentCart->products_count;
			$this->total_sum = $currentCart->total_sum;
		}
	}
	
	public function addItem($item, $quantity){
		$storedItem = array('quantity'=>0, 'price'=>$item->price, 'item'=>$item);
		if($this->products){
			if(array_key_exists($item->id, $this->products)){
				$storedItem = $this->products[$item->id];
			}
		}
		$storedItem['quantity'] += $quantity;
		$storedItem['price'] = $item->price * $storedItem['quantity'];
		$this->products[$item->id] = $storedItem;
		
		$this->saveCart();
	}
	
	public function deleteItem($item){
		if($this->products){
			if(array_key_exists($item->id, $this->products)){
				$currentItem = $this->products[$item->id];
				if(intval($currentItem['quantity'])>1){
					$this->products[$item->id]['quantity']--;
				}else{
					unset($this->products[$item->id]);
				}
			}
		}
		$this->saveCart();
	}
	
	private function saveCart(){
		$this->products_count = 0;
		$this->total_sum = 0;
		if($this->products)
			foreach ($this->products as &$product){
				$product['price'] = $product['quantity'] * $product['item']->price;
				$this->products_count += $product['quantity'];
				$this->total_sum += $product['price'];
			}
		Session::put('cart', $this);
		Session::save();
	}

	public static function getCurrentCart(){
		return Session::has('cart') ? Session::get('cart') : null;
	}
}
