@extends('layout.main')

@section('content')
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
                    <h5>0</h5>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Monto de Total</h3>
                </div>
                <div class="card-body">
                    <div class="circle circle_1 b"></div>
                    <div class="circle circle_2 b"></div>
                    <h5>0 <span class="coin">Lps</span></h5>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Atajos</h3>
                </div>
                <div class="card-body">
                    <div class="circle circle_1 c"></div>
                    <div class="circle circle_2 c"></div>
                    <div class="shortcuts">
                        <div> <span> F1 </span> <span> F2 </span> <span> F3 </span> </div>
                        <div> <span> - </span> <span> - </span> <span> - </span> </div>
                        <div> <span> Nueva reparación </span> <span> Técnicos </span> <span> Reparaciones </span> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="charts-container">
            <div>
                <h1>{{ $chart_repairs->options['chart_title'] }}</h1>
                {!! $chart_repairs->renderHtml() !!}
            </div>
        </div>
    </div>
    <script>
        {!! $chart_repairs->renderChartJsLibrary() !!}
        {!! $chart_repairs->renderJs() !!}
    </script>
@endsection
