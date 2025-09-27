<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    private $token ;

    public function __construct($resource, $token = null)
    {
        parent::__construct($resource);

        $this->token = $token;
    }

    public function toArray(Request $request): array
    {
        return [
            'token' =>$this->token,
            'name'=>$this->name,
            'email'=>$this->email
        
        ];
    }
}
