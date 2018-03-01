<?php
namespace App\Exceptions;
use Exception;
class CartException extends Exception
{
	public $params = null;
	public $message = null;
	public $code = null;
	
	public function __construct($params, $message, $code){
		$this->params = $params;
		$this->message = $message;
		$this->code = $code;
	}
	
	public function render($request, Exception $exception){  
		$response['error']['params'] = $this->params;
		$response['error']['message'] = $this->message;
		return response()->json($response, $this->code);
	}
}
?>