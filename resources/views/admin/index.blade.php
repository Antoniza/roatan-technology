@extends('layout.main')

@section('content')

    <body>
        <div class="dashboard-container">
            <h1>Información de Hoy</h1>
            <div class="cards-container">
                <div class="card">
                    <div class="card-header">
                        <h3>Reparaciones de Hoy</h3>
                    </div>
                    <div class="card-body">
                        <div class="circle circle_1 a"></div>
                        <div class="circle circle_2 a"></div>
                        <div class="card-content">
                            <h5>{{$todayData[0]->repairs}}</h5>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Monto de Total</h3>
                    </div>
                    <div class="card-body">
                        <div class="circle circle_1 b"></div>
                        <div class="circle circle_2 b"></div>
                        <div class="card-content">
                            <h5>{{$todayData[0]->total}} <span class="coin">Lps</span></h5>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Atajos</h3>
                    </div>
                    <div class="card-body">
                        <div class="circle circle_1 c"></div>
                        <div class="circle circle_2 c"></div>
                        <div class="shortcuts card-content">
                            <div> <span> F1 </span> <span> F2 </span> <span> F3 </span> </div>
                            <div> <span> - </span> <span> - </span> <span> - </span> </div>
                            <div> <span> Reparaciones </span> <span> Técnicos </span> <span> Productos y Servicios </span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="charts-container">
                <div>
                    <h1>{{ $chart_repairs->options['chart_title'] }}</h1>
                    {!! $chart_repairs->renderHtml() !!}
                </div>

                <div class="pie-chart">
                    <h1>{{ $repairs_pending->options['chart_title'] }}</h1>
                    {!! $repairs_pending->renderHtml() !!}
                </div>
            </div>
        </div>
    </body>
@endsection
@section('javascript')
{!! $chart_repairs->renderChartJsLibrary() !!}
{!! $chart_repairs->renderJs() !!}

{!! $repairs_pending->renderChartJsLibrary() !!}
{!! $repairs_pending->renderJs() !!}
@endsection
