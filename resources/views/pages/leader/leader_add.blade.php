@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'leader'
])

@section('content')
    <div class="content">
        <form class="col-md-12" action="{{ route('page.save', 'leader') }}" method="POST">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Add Divisi</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-md-3 col-form-label">Username</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Password</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="password" class="form-control" placeholder="Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Apps</label>
                        <div class="col-md-9">
                            <div class="form-group">
                            <select name="apps" class="form-control">
                                @foreach($apps as $app)
                                    <option value="{{ $app->id_apps }}">{{ $app->nama_apps }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info btn-round">Add Leader</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection