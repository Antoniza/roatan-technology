<?php

namespace App\Http\Controllers;

use App\Models\Product_service;
use Illuminate\Http\Request;

class ProductsServicesController extends Controller
{
    public function index(){
        $services = Product_service::where('type', 'like', '%' . 'Service' . '%');
        $products = Product_service::where('type', 'like', '%' . 'Product' . '%');
        return response()->view('admin.services_products', ['services' => $services, 'products' => $products]);
    }
}
