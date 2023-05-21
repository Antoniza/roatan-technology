<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{

    public function index(){

        $chart_options_repairs = [
            'chart_title' => 'Reparaciones por Día',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Repair',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'chart_color' => '99,72,50',
        ];
        $chart_repairs = new LaravelChart($chart_options_repairs);

        return response()->view('admin.index', compact('chart_repairs'));
    }
}
