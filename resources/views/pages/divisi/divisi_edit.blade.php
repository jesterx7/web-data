@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'divisi'
])

@section('content')
    <div class="content">
        <form class="col-md-12" action="{{ route('api.edit', ['divisi', $id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Edit Divisi</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-md-3 col-form-label">Nama Divisi</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="nama_divisi" class="form-control" placeholder="Nama Divisi" value="{{ $data->nama_divisi }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Apps</label>
                        <div class="col-md-9">
                            <div class="form-group">
                            <select name="apps" class="form-control">
                                <option value="0"></option>
                                @foreach($apps as $app)
                                    @if($app->id_apps == $data->id_apps)
                                        <option value="{{ $app->id_apps }}" selected="selected">{{ $app->nama_apps }}</option>
                                    @else
                                        <option value="{{ $app->id_apps }}">{{ $app->nama_apps }}</option>
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