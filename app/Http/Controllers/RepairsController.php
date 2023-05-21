<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use Illuminate\Http\Request;

class RepairsController extends Controller
{
    public function index(){
        $repairs = Repair::all();
        return response()->view('admin.repairs', ['repairs' => $repairs]);
    }
}
