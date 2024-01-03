<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function address($zip)
    {
        $address = Address::where('zip',intval($zip))->first();
        return response()->json(
            $address,
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
}
