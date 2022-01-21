<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Yaxint\Client;

class ProductController extends Controller
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        return $this->client->products();
    }
}
