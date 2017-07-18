@extends('admin.layouts.app')

@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card card-inverse card-primary">
                    <div class="card-block pb-0">
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-transparent active dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-settings"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                        <h4 class="mb-0">9.823</h4>
                        <p>Members online</p>
                    </div>
                    <div class="chart-wrapper px-3" style="height:70px;">
                        <canvas id="card-chart1" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card card-inverse card-info">
                    <div class="card-block pb-0">
                        <button type="button" class="btn btn-transparent active p-0 float-right">
                            <i class="icon-location-pin"></i>
                        </button>
                        <h4 class="mb-0">9.823</h4>
                        <p>Members online</p>
                    </div>
                    <div class="chart-wrapper px-3" style="height:70px;">
                        <canvas id="card-chart2" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card card-inverse card-warning">
                    <div class="card-block pb-0">
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-transparent active dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-settings"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                        <h4 class="mb-0">9.823</h4>
                        <p>Members online</p>
                    </div>
                    <div class="chart-wrapper" style="height:70px;">
                        <canvas id="card-chart3" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card card-inverse card-danger">
                    <div class="card-block pb-0">
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-transparent active dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-settings"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                        <h4 class="mb-0">9.823</h4>
                        <p>Members online</p>
                    </div>
                    <div class="chart-wrapper px-3" style="height:70px;">
                        <canvas id="card-chart4" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <div class="card">
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">Traffic</h4>
                        <div class="small text-muted">November 2015</div>
                    </div>
                    <!--/.col-->
                    <div class="col-sm-7 hidden-sm-down">
                        <button type="button" class="btn btn-primary float-right"><i class="icon-cloud-download"></i>
                        </button>
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                                <label class="btn btn-outline-secondary">
                                    <input type="radio" name="options" id="option1">Day
                                </label>
                                <label class="btn btn-outline-secondary active">
                                    <input type="radio" name="options" id="option2" checked="">Month
                                </label>
                                <label class="btn btn-outline-secondary">
                                    <input type="radio" name="options" id="option3">Year
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--/.col-->
                </div>
                <!--/.row-->
                <div class="chart-wrapper" style="height:300px;margin-top:40px;">
                    <canvas id="main-chart" class="chart" height="300"></canvas>
                </div>
            </div>
            <div class="card-footer">
                <ul>
                    <li>
                        <div class="text-muted">Visits</div>
                        <strong>29.703 Users (40%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    <li class="hidden-sm-down">
                        <div class="text-muted">Unique</div>
                        <strong>24.093 Users (20%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    <li>
                        <div class="text-muted">Pageviews</div>
                        <strong>78.706 Views (60%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    <li class="hidden-sm-down">
                        <div class="text-muted">New Users</div>
                        <strong>22.123 Users (80%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    <li class="hidden-sm-down">
                        <div class="text-muted">Bounce Rate</div>
                        <strong>40.15%</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!--/.card-->
    </div>
@stop
@push('script')
<script src="/assets/js/views/main.js"></script>
<script src="/assets/bower_components/chart.js/dist/Chart.min.js"></script>
@endpush