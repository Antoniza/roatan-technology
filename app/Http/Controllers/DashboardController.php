<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{

    public function index(){

        $chart_options_repairs = [
            'chart_title' => 'Reparaciones por día',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Repair',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
            'chart_color' => '255,174,0',
        ];
        $chart_repairs = new LaravelChart($chart_options_repairs);

        $chart_repairs_pending = [
            'chart_title' => 'Reparaciones del mes',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Repair',
            'group_by_field' => 'client_name',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];
        $repairs_pending = new LaravelChart($chart_repairs_pending);

        return response()->view('admin.index', compact('chart_repairs', 'repairs_pending'));
    }
}
