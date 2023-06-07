<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'group_by_field' => 'status',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];
        $repairs_pending = new LaravelChart($chart_repairs_pending);

        $todayData = DB::table('repairs')
            ->selectRaw('count(*) as repairs, sum(total) as total')
            ->whereDate('created_at', Carbon::today())
            ->get();

        return response()->view('admin.index', compact('chart_repairs', 'repairs_pending', 'todayData'));
    }
}
