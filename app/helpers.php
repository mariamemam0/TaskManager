<?php
if(! function_exists('apiResponse')){
    function apiResponse($code , $message ,$data = null){
        $response = ['message'=>$message];
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response, $code);
    }
}




