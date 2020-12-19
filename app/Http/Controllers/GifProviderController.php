<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
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
        $keywords = DB::table('keywords')->where('keyword', $string)->get();
        $result = [];
        foreach ($keywords as $key => $value) {
            array_push($result, $value->keyword);
        }
        Cache::store('redis')->put('keywords', $result, 21600);
        $response = [
            "results" => $result
        ];
        return $result;
    }

    public function keywordStats($keyword){
        $string = preg_replace("/[^A-Za-z0-9_]/", "_", $keyword );
        $string = str_replace("_", " " ,$string);
        $string = preg_replace('/\s+/', '', $string);
        if($string) {
            $keywords = DB::table('keywords')->where('keyword', $string)->groupBy('gifproviders_id')->get();
            
            return $keywords;
        } return "error 404";
    }

    public function setProvider(Request $request) {
        $data = $request->all();
        $idProvider = $data->identifier;
        $provider = DB::table('gifproviders')->where('id', $identifier)->first();
        if($provider) {
            $clear = Artisan::call('cache:clear');
            if($clear) {
                return "success 204";
            }
        };
        return "error 404";
    }
}
