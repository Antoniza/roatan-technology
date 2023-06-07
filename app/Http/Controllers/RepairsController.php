<?php

namespace App\Http\Controllers;

use App\Mail\finishRepair;
use App\Mail\newRepairMail;
use App\Models\Product;
use App\Models\Repair;
use App\Models\Service;
use App\Models\Technical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Mockery\Undefined;

class RepairsController extends Controller
{
    public function index(){
        $repairs = Repair::all();
        return response()->view('admin.repairs', ['repairs' => $repairs]);
    }

    public function new_repair(){
        $technicals = Technical::all();
        $products = Product::all();
        $services = Service::all();
        return response()->view('admin.newRepair', ['technicals' => $technicals, 'products' => $products, 'services' => $services]);
    }

    public function store(Request $request){
        $validator = $request->validate([
            'client_name' => 'required',
            'client_email' => ['required','email'],
            'client_phone' => 'required',
            'service_required' => 'required',
            'technical' => 'required',
            'device' => 'required'
        ]);

        $repair = new Repair();
        $repair -> repair_code = $request->repair_code;
        $repair -> client_name = $request->client_name;
        $repair -> client_email = $request->client_email;
        $repair -> client_phone = $request->client_phone;
        $repair -> device = $request->device;
        $repair -> service_required = $request->service_required;
        $repair -> technical = $request->technical;
        $repair -> created_by = Auth::user()->id;
        $repair -> status = 'Pendiente';
        $repair -> save();

        $service = Service::where('id','=', $request->service_required)->get();

        $technical = Technical::where('id','=', $request->technical)->get();

        Mail::to($request->client_email)->send(new newRepairMail($request->repair_code, $request->client_name, $request->device, $service[0]->name, $technical[0]->name));

        return response()->json(['message'=>'Reparación puesta en progreso.']);
    }

    public function cancelRepair($id){
        $repair = Repair::find($id);
        $repair -> status = "Cancelado";
        $repair->save();

        return response()->json(['message'=>'Reparación cancelada']);
    }

    public function finishRepair($id){
        $repair = Repair::find($id);
        $repair -> status = "Terminado";
        $repair->save();

        return response()->json(['message'=>'Reparacion terminada.']);
    }

    public function complete_repair($id)
    {
        $repair = Repair::find($id);
        $products = Product::all();
        $service = Service::where('id','=',$repair->service_required)->get();
        return response()->view('admin.completeRepair', ['repair' => $repair, 'products'=>$products, 'service' => $service]);
    }

    public function complete(Request $request, $id)
    {
        $repair = Repair::find($id);
        $repair -> repair_details = json_encode($request->repair_details);
        $repair -> status = "Finalizado";
        $repair -> total = $request -> total;
        $repair->save();

        $service = Service::where('id','=', $repair->service_required)->get();

        $technical = Technical::where('id','=', $repair->technical)->get();

        for ($i = 0; $i < count($request->repair_details); $i++) {
            if($request->repair_details[$i]['type'] == 'product'){
                $item = Product::find($request->repair_details[$i]['id']);
                $item->quantity = $item->quantity - $request->repair_details[$i]['quantity'];
                $item->save();
            }
        }

        Mail::to($repair->client_email)->send(new finishRepair($repair->repair_code, $repair->client_name, $repair->device, $service[0]->name, $technical[0]->name, json_decode($repair->repair_details), $repair->total));

        return response()->json(['message'=>'Reparacion completada.']);
    }
}
