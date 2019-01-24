<?php

namespace App\API;

class ApiError 
{
    public static function errorMessage($message, $code = null)
    {
        return [
            'data' => [
                'msg' => $message,
                'code' => $code
            ]
        ];
    }
}