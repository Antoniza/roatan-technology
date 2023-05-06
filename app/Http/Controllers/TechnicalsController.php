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
}
