@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'aplikasi'
])

@section('content')
    <div class="content">
        <form class="col-md-12" action="{{ route('api.edit', ['aplikasi', $id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Add Aplikasi</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-md-3 col-form-label">Nama Aplikasi</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="nama_aplikasi" class="form-control" placeholder="Nama Aplikasi" value="{{ $data->nama_apps }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Link</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="link" class="form-control" placeholder="Link" value="{{ $data->link_apps }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Company</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <select name="company" class="form-control">
                                    <option value="0"></option>
                                    @foreach($companies as $company)
                                        @if($company->id_company == $data->id_company)<option value="{{ $company->id_company }}" selected="selected">{{ $company->nama_company }}</option>
                                    @else
                                        <option value="{{ $company->id_company }}">{{ $company->nama_company }}</option>
                                    @endif
                                    @endforeach
                                </select>
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