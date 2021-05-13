@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'company'
])

@section('content')
    <div class="content">
        <form class="col-md-12" action="{{ route('api.edit', ['company', $id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Edit Company</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-md-3 col-form-label">Nama Company</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="nama_company" class="form-control" placeholder="Nama Company" value="{{ $data->nama_company }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info btn-round">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection