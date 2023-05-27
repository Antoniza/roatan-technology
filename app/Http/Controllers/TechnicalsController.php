<?php

namespace App\Http\Controllers;

use App\Models\Technical;
use Illuminate\Http\Request;

class TechnicalsController extends Controller
{
    public function index(){
        $technicals = Technical::all();
        return response()->view('admin.technicals', ['technicals' => $technicals]);
    }

    public function store(Request $request){
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'speciality' => 'required',
        ]);

        $technical = new Technical();
        $technical -> name = $request -> name;
        $technical -> speciality = $request -> speciality;
        $technical -> email = $request -> email;
        $technical -> phone = $request -> phone;
        $technical -> save();

        return response()->json(['message'=>'Técnico creado correctamente.']);
    }

    public function delete($id){
        $technical = Technical::find($id);
        $technical->delete();

        return response()->json(['message'=>'Técnico eliminado correctamente.']);
    }

    public function edit($id){
        $technical = Technical::find($id);

        return response()->json(['technicals' => $technical]);
    }

    public function update(Request $request, $id){
        $technical = Technical::find($id);
        $technical -> name = $request -> name;
        $technical -> speciality = $request -> speciality;
        $technical -> email = $request -> email;
        $technical -> phone = $request -> phone;
        $technical -> save();

        return response()->json(['message'=>'Técnico actualizado correctamente.']);
    }
}
