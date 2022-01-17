<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Config;
use Illuminate\Support\Facades\Http;

class ApiServices extends Model
{

    /// Bắn API lên site autolike.cc
    public function postServices($url, $body) {
        try {
            $header = [
                'Content-Type' => 'application/json',
                'Token' => Config::get('api.key.token'),
                'agency-secret-key' => Config::get('api.key.agency')
            ];
            $response = Http::withHeaders($header)->post($url, $body);
            return $response;
        }
        catch (\Exception $e) {
            return "Lỗi xảy ra khi post API";
        }
    }
}
