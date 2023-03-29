<?php

namespace App\Services;

use App\Models\Address;
use GuzzleHttp\Client;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class AddressService extends Address
{

    public static function getZipCode(string $zip_code)
    {
        $validator = Validator::make(
            ['zipcode' => $zip_code],
            ['zipcode' => 'required|size:8'],
            [
                'zipcode.size' => 'O formato do CEP é inválido.',
                'zipcode.required' => 'O CEP é um campo obrigatório.',
            ]
        );

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'messages' => $validator->errors()
            ], 400));
        }

        $zip_code_cache = Redis::get($zip_code);

        if (Redis::get($zip_code)) {
            return json_decode($zip_code_cache);
        }

        $client = new Client();
        $response = $client->request('GET', 'https://viacep.com.br/ws/' . $zip_code . '/json');

        $content = $response->getBody()->getContents();

        Redis::set($zip_code, $content);
        Redis::expire($zip_code, 3600);

        return json_decode($content);
    }
}
