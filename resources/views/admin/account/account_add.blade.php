@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'account',
    'subtab' => 'Account'
])

@section('content')
    <div class="content">
        <form class="col-md-12" action="{{ route('admin.save', 'account') }}" method="POST">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Add Account</h5>
                </div>
                @include('layouts.errors_templates.errors_data')
                @include('layouts.success_templates.success_add')
                <div class="card-body">
                    <div class="row">
                        <label class="col-md-3 col-form-label">Name</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Email</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Password</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Confirm Password</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Level</label>
                        <div class="col-md-9">
                            <div class="form-group">
                            <select id="select--apps" name="level" class="form-control">
                                <option value="0">Admin</option>
                                <option value="1">User</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info btn-round">Add Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection