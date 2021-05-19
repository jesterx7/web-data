@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'leader'
])

@section('content')
    <div class="content">
        <form class="col-md-12" action="{{ route('api.edit', ['leader', $id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Edit Leader</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-md-3 col-form-label">Username</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $data->username }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Password</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="password" class="form-control" placeholder="Password" value="{{ $data->password }}" required>
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