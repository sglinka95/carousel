<?php

namespace App\Services\Yaxint;

use Illuminate\Support\Facades\Http;
use App\Http\Resources\Product;
use App\Http\Resources\ProductCollection;

class Client
{
    public function __construct(
        protected string $uri,
        protected string $token
    ) {
    }

    public function products()
    {
        $request = Http::withToken(
            token: $this->token,
        )->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ]);

        $response = $request->get(
            "{$this->uri}/products",
            [
                'limit' => '20'
            ]
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        $response = json_decode($response, true);
        $data = $response['data'];

        return ProductCollection::make($data)->resolve();
    }
}
