<?php

namespace App\Http\Controllers;

use App\Models\Product_service;
use Illuminate\Http\Request;

class ProductsServicesController extends Controller
{
    public function index(){
        $services = Product_service::where('type', '=', 'service')->get();
        $products = Product_service::where('type', '=', 'product')->get();
        return response()->view('admin.services_products', ['services' => $services, 'products' => $products]);
    }

    public function store_product(Request $request){
        $request->validate([
            'name' => ['required', 'unique:product_services'],
            'quantity' => 'required',
            'price' => 'required'
        ]);

        $product = new Product_service();
        $product -> name = $request -> name;
        $product -> type = $request -> type;
        $product -> quantity = $request -> quantity;
        $product -> price = $request -> price;
        $product -> updated_by = $request -> user_id;
        $product -> save();

        return response()->json(['message'=>'Producto creado correctamente.']);
    }

    public function store_service(Request $request){
        $request->validate([
            'name' => ['required', 'unique:product_services'],
            'quantity' => 'required',
            'price' => 'required'
        ]);

        $product = new Product_service();
        $product -> name = $request -> name;
        $product -> type = $request -> type;
        $product -> quantity = $request -> quantity;
        $product -> price = $request -> price;
        $product -> updated_by = $request -> user_id;
        $product -> save();

        return response()->json(['message'=>'Servicio creado correctamente.']);
    }

    public function edit_product($id){
        $product = Product_service::find($id);

        return response()->json(['product' => $product]);
    }

    public function edit_service($id){
        $service = Product_service::find($id);

        return response()->json(['service' => $service]);
    }

    public function update_product(Request $request, $id){
        $product = Product_service::find($id);
        $product -> name = $request -> name;
        $product -> type = $request -> type;
        $product -> quantity = $request -> quantity;
        $product -> price = $request -> price;
        $product -> updated_by = $request -> user_id;
        $product -> save();

        return response()->json(['message'=>'Producto actualizado correctamente.']);
    }

    public function update_service(Request $request, $id){
        $product = Product_service::find($id);
        $product -> name = $request -> name;
        $product -> type = $request -> type;
        $product -> price = $request -> price;
        $product -> updated_by = $request -> user_id;
        $product -> save();

        return response()->json(['message'=>'Servicio actualizado correctamente.']);
    }

    public function delete_product($id){
        $product = Product_service::find($id);
        $product->delete();

        return response()->json(['message'=>'Producto eliminado correctamente.']);
    }

    public function delete_service($id){
        $service = Product_service::find($id);
        $service->delete();

        return response()->json(['message'=>'Servicio eliminado correctamente.']);
    }
}
