<?php 

namespace App\Traits;

trait JsonResponsible {

	public function jsonResponse(array $array,int $statusCode = 200)
	{
		return response()->json($array,$statusCode);
	}
}