<?php
namespace App\Helpers;



class ApiResponse {



    static public function sendResponse($code , $msg , $data){
        $response =[
            'status' => $code,
            'message' =>$msg,
            'data' =>$data
        ];

        return response()->json($response , $code);
    }
}