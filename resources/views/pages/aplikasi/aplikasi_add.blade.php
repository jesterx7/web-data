@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'aplikasi'
])

@section('content')
    <div class="content">
        <form class="col-md-12" action="{{ route('page.save', 'aplikasi') }}" method="POST">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Add Aplikasi</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-md-3 col-form-label">Nama Aplikasi</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="nama_aplikasi" class="form-control" placeholder="Nama Aplikasi" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Link</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="link" class="form-control" placeholder="Link" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Company</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <select name="company" class="form-control">
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id_company }}">{{ $company->nama_company }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info btn-round">Add Aplikasi</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection