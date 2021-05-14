@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'tutupbuka',
    'subtab' => 'Close & Open'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Close & Open</h4>
                        @include('components.form.filter-form')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @include('layouts.errors_templates.errors_data')
                            @include('components.table-view.table-data.'. $page. '-table-data')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection