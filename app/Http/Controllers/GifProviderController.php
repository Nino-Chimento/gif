<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Gifprovider;

class GifProviderController extends Controller
{
    public function getProviders() {
        $gifProviders = Gifprovider::all();
        return $gifProviders;
    }

    public function getStats($identifier) {
        dump($identifier);
        $gifProvider = DB::table('gifproviders')->where('id', $identifier)->first();
        if($gifProvider) {
            $calls = $gifProvider->calls;
            $keywords = DB::table('keywords')->where('gifproviders_id', $identifier)->get();
            $result = [
                "calls" => $calls,
                "keywords" =>$keywords,
            ];
            return $result;
                
        }
        return "error 404";
    }

    public function keyword($keyword){
        $string = preg_replace("/[^A-Za-z0-9_]/", "_", $keyword );
        $string = str_replace("_", " " ,$string);
        $string = preg_replace('/\s+/', ' ', $string);
        dump($string);
        die("key");
    }
}
