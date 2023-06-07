<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class ProductsServicesController extends Controller
{
    public function index(){
        $services = Service::all();
        $products = Product::all();
        return response()->view('admin.services_products', ['services' => $services, 'products' => $products]);
    }

    public function store_product(Request $request){
        $request->validate([
            'name' => ['required', 'unique:Products'],
            'quantity' => 'required',
            'price' => 'required'
        ]);

        $product = new Product();
        $product -> name = $request -> name;
        $product -> quantity = $request -> quantity;
        $product -> price = $request -> price;
        $product -> updated_by = $request -> user_id;
        $product -> save();

        return response()->json(['message'=>'Producto creado correctamente.']);
    }

    public function store_service(Request $request){
        $request->validate([
            'name' => ['required', 'unique:services'],
            'price' => 'required'
        ]);

        $service = new Service();
        $service -> name = $request -> name;
        $service -> price = $request -> price;
        $service -> updated_by = $request -> user_id;
        $service -> save();

        return response()->json(['message'=>'Servicio creado correctamente.']);
    }

    public function edit_product($id){
        $product = Product::find($id);

        return response()->json(['product' => $product]);
    }

    public function edit_service($id){
        $service = Service::find($id);

        return response()->json(['service' => $service]);
    }

    public function update_product(Request $request, $id){
        $product = Product::find($id);
        $product -> name = $request -> name;
        $product -> quantity = $request -> quantity;
        $product -> price = $request -> price;
        $product -> updated_by = $request -> user_id;
        $product -> save();

        return response()->json(['message'=>'Producto actualizado correctamente.']);
    }

    public function update_service(Request $request, $id){
        $product = Service::find($id);
        $product -> name = $request -> name;
        $product -> price = $request -> price;
        $product -> updated_by = $request -> user_id;
        $product -> save();

        return response()->json(['message'=>'Servicio actualizado correctamente.']);
    }

    public function delete_product($id){
        $product = Product::find($id);
        $product->delete();

        return response()->json(['message'=>'Producto eliminado correctamente.']);
    }

    public function delete_service($id){
        $service = Service::find($id);
        $service->delete();

        return response()->json(['message'=>'Servicio eliminado correctamente.']);
    }

    public function search(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $autocomplate = Product::orderby('name', 'asc')->select('*')->limit(5)->get();
        } else {
            $autocomplate = Product::orderby('name', 'asc')->select('*')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($autocomplate as $autocomplate) {
            $response[] = array("value" => $autocomplate->id, "label" => $autocomplate->name);
        }

        echo json_encode($response);
        exit;
    }

    public function getItem(Request $request)
    {
        $item = Product::find($request->item);

        return response()->json(['message' => 'Buscando...', 'data' => $item, 'quantity' => $request->quantity]);
    }
}
