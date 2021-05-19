@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'company'
])

@section('content')
    <div class="content">
        <form class="col-md-12" action="{{ route('page.save', 'company') }}" method="POST">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-header">
                    @include('layouts.errors_templates.errors_data')
                    <h5 class="title">Add Company</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-md-3 col-form-label">Nama Company</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="nama_company" class="form-control" placeholder="Nama Company" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info btn-round">Add Company</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection