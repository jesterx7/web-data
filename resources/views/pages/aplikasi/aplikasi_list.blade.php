@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'aplikasi',
    'subtab' => 'Apps'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Apps</h4>
                        @include('components.form.filter-form')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @include('components.table-view.table-data.'. $page. '-table-data')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection