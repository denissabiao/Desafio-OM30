<?php

namespace App\Http\Controllers;

use App\Services\AddressService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private $addressService;


    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function zipCode(string $zip_code)
    {
        $data_zip_code = $this->addressService->getZipCode($zip_code);

        return response()->json($data_zip_code, 200);
    }
}
