<?php

namespace Tests\Unit\api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Session;

class CartControllerTest extends TestCase
{
	public function setUp() {
		parent::setUp(); 
		Session::start();
	}

    public function testAdd()
    {
    	//correct params
    	$element = array('product_id'=>2, 'quantity'=>6, '_token'=> Session::token());	
    	$this->call('POST', route('cart.add'), $element)
		->assertStatus(200);
    	
		//incorrect quantity
		$element['quantity'] = 0;
		$this->call('POST', route('cart.add'), $element)
		->assertStatus(400)
		->assertJsonStructure([
				'error'
		]);
		
		//incorrect quantity
		$element['quantity'] = 10;
		$this->call('POST', route('cart.add'), $element)
		->assertStatus(400)
		->assertJsonStructure([
				'error'
		]);
		
		//incorrect product_id
		$element['quantity'] = 1;
		$element['product_id'] = 0;
		$this->call('POST', route('cart.add'), $element)
		->assertStatus(400)
		->assertJsonStructure([
				'error'
		]);
    }
    
    public function testDelete()
    {
    	//correct params
    	$element = array('product_id'=>2, '_token'=> Session::token());
    	$this->call('DELETE', route('cart.delete', $element['product_id']), $element)
    	->assertStatus(200);
    	
    	//incorrect params
    	$element['product_id'] = 0;
    	$this->call('DELETE', route('cart.delete', $element['product_id']), $element)
    	->assertStatus(400)
    	->assertJsonStructure([
				'error'
		]);
    }
}
