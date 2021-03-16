<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function create_payment_page()
    {
        $fields = [
            "profile_id" => env('PAYTABS_PROFILE_ID'),
            "tran_type" => "Sale",
            "tran_class" => "ecom",
            "cart_id" => "Bsaray Sample Payment",
            "cart_description" => "Dummy Order 35925502061445345",
            "cart_currency" => "USD",
            "cart_amount" => 46.17,
            "callback" => "https://yourdomain.com/yourcallback",
            "return" => "https://yourdomain.com/yourpage",
            "customer_details" => [
                "name" => "John Smith",
                "email" => "jsmith@gmail.com",
                "street1" => "404, 11th st, void",
                "city" => "dubai",
                "country" => "AE",
                "ip" => "94.204.129.89"
            ],
            "shipping_details" => [
                "name" => "name1 last1",
                "email" => "email1@domain.com",
                "phone" => "971555555555",
                "street1" => "street2",
                "city" => "dubai",
                "state" => "dubai",
                "country" => "AE",
                "zip" => "54321",
                "ip" => "2.2.2.2"
            ],
        ];

        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'authorization' => env('PAYTABS_SERVER_KEY'),
            'Content-type' => 'application/json'
        ])->post('https://secure-global.paytabs.com/payment/request', $fields);

        return $response->json();

    }

    function query_transaction()
    {
        $fields = [
            "profile_id" => env('PAYTABS_PROFILE_ID'),
            'tran_ref' => 'TST2107500114813' // example
        ];
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'authorization' => env('PAYTABS_SERVER_KEY'),
            'Content-type' => 'application/json'
        ])->post('https://secure-global.paytabs.com/payment/query', $fields);

        return $response->json();
    }
}
