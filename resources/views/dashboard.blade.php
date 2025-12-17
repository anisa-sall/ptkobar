@extends('layouts.app')

@section('title', 'Dashboard - PT. Kobar Indonesia')

@section('plugin-css')
<link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/select.dataTables.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                    <!-- METRIK 1 (Your Today's Work) -->
                                    <div>
                                        <p class="statistics-title">Your Today's Work</p>
                                        <h3 class="rate-percentage" id="user-today-work">{{ $today_count ?? 0 }}</h3>
                                        <p class="text-success d-flex">
                                            <i class="mdi mdi-check-circle"></i>
                                            <span id="today-change">+0%</span>
                                        </p>
                                    </div>

                                    <!-- METRIK 2 (Your This Week) -->
                                    <div>
                                        <p class="statistics-title">Your This Week</p>
                                        <h3 class="rate-percentage" id="user-this-week">{{ $this_week ?? 0 }}</h3>
                                        <p class="text-warning d-flex">
                                            <i class="mdi mdi-calendar-week"></i>
                                            <span id="week-change">0%</span>
                                        </p>
                                    </div>

                                    <!-- METRIK 3 (Your Efficiency) -->
                                    <div>
                                        <p class="statistics-title">{{ $efficiency_title ?? 'Your Efficiency' }}</p>
                                        <h3 class="rate-percentage">{{ $efficiency_value ?? '0%' }}</h3>
                                        <p class="{{ $efficiency_color ?? 'text-muted' }} d-flex">
                                            <i class="mdi {{ $efficiency_icon ?? 'mdi-speedometer' }}"></i>
                                            <span>{{ $efficiency_subtext ?? '0/0' }}</span>
                                        </p>
                                    </div>

                                    <!-- METRIK 4: Your PO Value -->
                                    <div class="d-none d-md-block">
                                        <p class="statistics-title">Your PO Value</p>
                                        <h3 class="rate-percentage" id="user-po-value">Rp 2.5 jt</h3>
                                        <p class="text-warning d-flex">
                                            <i class="mdi mdi-cash"></i>
                                            <span id="po-value-change">Medium</span>
                                        </p>
                                    </div>

                                    <!-- METRIK 5: Your Accuracy -->
                                    <div class="d-none d-md-block">
                                        <p class="statistics-title">Your Data Accuracy</p>
                                        <h3 class="rate-percentage" id="user-accuracy">92%</h3>
                                        <p class="text-success d-flex">
                                            <i class="mdi mdi-check-decagram"></i>
                                            <span id="accuracy-change">Excellent</span>
                                        </p>
                                    </div>

                                    <!-- METRIK 6: Your Activity Score -->
                                    <div class="d-none d-md-block">
                                        <p class="statistics-title">Your Activity Score</p>
                                        <h3 class="rate-percentage" id="user-score">85</h3>
                                        <p class="text-success d-flex">
                                            <i class="mdi mdi-star-circle"></i>
                                            <span id="score-change">Excellent</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="row">
                            <div class="col-lg-8 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h4 class="card-title card-title-dash">Data Surat Jalan Keluar</h4>
                                                        <div id="performance-date-range" class="text-muted small mt-1" style="font-size: 0.7rem;">
                                                            Periode: ({{ $current_week_range ?? '14 Jan - 20 Jan' }}) - ({{ $last_week_range ?? '7 Jan - 13 Jan' }})
                                                        </div>
                                                    </div>
                                                    <div id="performance-line-legend"></div>
                                                </div>
                                                <div class="chartjs-wrapper mt-5">
                                                    <canvas id="performaneLine"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                        <div class="card bg-primary card-rounded">
                                            <div class="card-body pb-0">
                                                <h4 class="card-title card-title-dash text-white mb-4">Status Summary Invoice</h4>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="status-summary-ight-white mb-1">Invoices This Month</p>
                                                        <h2 class="text-info">{{ $invoice_count ?? 0 }}</h2>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="status-summary-chart-wrapper pb-4">
                                                            <canvas id="status-summary"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="circle-progress-width">
                                                                <div id="totalVisitors" class="progressbar-js-circle pr-2"></div>
                                                            </div>
                                                            <div>
                                                                <p class="text-small text-muted mb-2">Critical Stock</p>
                                                                <h4 class="mb-0 fw-bold">{{ $critical_percentage ?? 0 }}%</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="circle-progress-width">
                                                                <div id="visitperday" class="progressbar-js-circle pr-2"></div>
                                                            </div>
                                                            <div>
                                                                <p class="text-small text-muted mb-2">Restocking</p>
                                                                <h4 class="mb-0 fw-bold">{{ $restock_items ?? 0 }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-8 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h4 class="card-title card-title-dash">Data Penjualan Part</h4>
                                                        <p class="card-subtitle card-subtitle-dash">Analisis penjualan part berdasarkan nominal dan tren per bulan</p>
                                                    </div>
                                                    <div>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" 
                                                                    type="button" 
                                                                    id="dropdownMenuButton2" 
                                                                    data-bs-toggle="dropdown" 
                                                                    aria-haspopup="true" 
                                                                    aria-expanded="false">
                                                                <span id="selected-part-name">
                                                                    {{ $selected_part_name ?? 'Pilih Part' }}
                                                                </span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2" style="max-height: 300px; overflow-y: auto;">
                                                                <h6 class="dropdown-header">Daftar Part</h6>
                                                                @if(!empty($parts))
                                                                    @foreach($parts as $part)
                                                                        <a class="dropdown-item select-part" 
                                                                        href="{{ url('/dashboard?selected_part=' . urlencode($part->nopart)) }}">
                                                                            {{ $part->namapart }}
                                                                        </a>
                                                                    @endforeach
                                                                @else
                                                                    <a class="dropdown-item text-muted">Tidak ada data part</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                                    <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                                        <h2 class="me-2 fw-bold" id="total-current-year">
                                                            Rp {{ number_format($total_current_year ?? 0, 0, ',', '.') }}
                                                        </h2>
                                                        <h4 class="me-2">Tahun {{ date('Y') }}</h4>
                                                        @if(isset($has_comparison_data) && $has_comparison_data && isset($percentage_change))
                                                            <h4 class="{{ $percentage_class ?? 'text-muted' }}" id="percentage-change">
                                                                ({{ ($percentage_change >= 0 ? '+' : '') . number_format($percentage_change, 1) }}%)
                                                            </h4>
                                                        @else
                                                            <h4 class="text-muted" id="percentage-change">(+0.0%)</h4>
                                                        @endif
                                                    </div>
                                                    <div class="me-3">
                                                        <div id="marketing-overview-legend"></div>
                                                    </div>
                                                </div>
                                                <div class="chartjs-bar-wrapper mt-3">
                                                    <canvas id="marketingOverview"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                                            <h4 class="card-title card-title-dash">Status Purchase Order</h4>
                                                        </div>
                                                        <canvas class="my-auto" id="doughnutChart" height="200"></canvas>
                                                        <div id="doughnut-chart-legend" class="mt-5 text-center"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('plugin-js')
<script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('vendors/progressbar.js/progressbar.min.js') }}"></script>
@endsection

@section('scripts')
<script src="{{ asset('js/dashboard.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/Chart.roundedBarCharts.js') }}"></script>

<script>
// Data untuk JavaScript charts
var dynamicDoughnutData = {
    labels: {!! json_encode($po_status_labels ?? ['OPEN', 'PARTIAL', 'CLOSED']) !!},
    datasets: [{
        data: {!! json_encode($po_status_data ?? [0, 0, 0]) !!},
        backgroundColor: {!! json_encode($po_status_colors_array ?? ['#1F3BB3', '#FDD0C7', '#52CDFF']) !!},
        borderWidth: 2,
        hoverOffset: 15
    }]
};

var statusSummaryChartData = {
    labels: {!! json_encode($status_labels ?? ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI']) !!},
    data: {!! json_encode($status_data ?? [0, 0, 0, 0, 0, 0]) !!}
};

var marketOverviewChartData = {
    labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
    currentYearData: {!! json_encode($current_year_data ?? []) !!},
    lastYearData: {!! json_encode($last_year_data ?? []) !!},
    selectedPart: "{{ $selected_part_id ?? '' }}",
    selectedPartName: "{{ $selected_part_name ?? 'Pilih Part' }}",
    totalCurrentYear: {{ $total_current_year ?? 0 }},
    totalLastYear: {{ $total_last_year ?? 0 }},
    currentYear: {{ date('Y') }},
    lastYear: {{ date('Y') - 1 }},
    hasComparisonData: {{ isset($has_comparison_data) ? 'true' : 'false' }},
    percentageChange: {{ $percentage_change ?? 0 }},
    percentageClass: "{{ $percentage_class ?? 'text-success' }}"
};

var performanceLineChartData = {
    labels: {!! json_encode($days_of_week ?? ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT']) !!},
    currentWeekData: {!! json_encode($current_week_data ?? []) !!},
    lastWeekData: {!! json_encode($last_week_data ?? []) !!},
    currentWeekRange: "{{ $current_week_range ?? '' }}",
    lastWeekRange: "{{ $last_week_range ?? '' }}"
};
</script>
@endsection