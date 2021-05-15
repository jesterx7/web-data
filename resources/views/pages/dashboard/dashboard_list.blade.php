@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-simple-remove text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Close / 关</p>
                                    <p class="card-title">{{ $index_data['tutup_today'] }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar-o"></i> Today
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-check-2 text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Open / 开</p>
                                    <p class="card-title">{{ $index_data['buka_today'] }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar-o"></i> Today
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-single-copy-04 text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Close / 关</p>
                                    <p class="card-title">{{ $index_data['tutup_month'] }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> In this Month
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-key-25 text-primary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Open / 开</p>
                                    <p class="card-title">{{ $index_data['buka_month'] }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> In this Month
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Latest Close / 今天关的账号</h5>
                        <p class="card-category">10 Latest Close</p>
                    </div>
                    <div class="card-body ">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    Username
                                </th>
                                <th>
                                    Close Date / 截止日期
                                </th>
                                <th>
                                    Apps
                                </th>
                            </thead>
                            <tbody>
                                @foreach($index_data['current_tutup'] as $tutup)
                                    <tr>
                                        <td>{{ $tutup->anak->username }}
                                        <td>{{ $tutup->tanggal_tutup }}</td>
                                        <td>{{ $tutup->anak->apps->nama_apps }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="card-stats">
                            <a class="btn-dashboard--see-all" href="{{ route('page.index', 'tutupbuka') }}">
                                <i class="nc-icon nc-tap-01"></i>
                                See All
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Latest Open / 今天开的账号</h5>
                        <p class="card-category">10 Latest Open</p>
                    </div>
                    <div class="card-body ">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    Username
                                </th>
                                <th>
                                    Open Date / 开馆日
                                </th>
                                <th>
                                    Apps
                                </th>
                            </thead>
                            <tbody>
                                @foreach($index_data['current_buka'] as $buka)
                                    <tr>
                                        <td>{{ $buka->anak->username }}
                                        <td>{{ $buka->tanggal_buka }}</td>
                                        <td>{{ $buka->anak->apps->nama_apps }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="card-stats">
                            <a class="btn-dashboard--see-all" href="{{ route('page.index', 'tutupbuka') }}">
                                <i class="nc-icon nc-tap-01"></i>
                                See All
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>
@endpush