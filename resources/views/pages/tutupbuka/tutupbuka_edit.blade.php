@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'tutupbuka',
    'subtab' => 'Close & Open'
])

@section('content')
    <div class="content">
        <form class="col-md-12" action="{{ route('api.edit', ['tutupbuka', $id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Edit Close & Open</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-md-3 col-form-label">Close Date</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="datetime" name="close_date" class="form-control" placeholder="Tanggal Tutup" value="{{ $data->tanggal_tutup }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Open Date</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="datetime" name="open_date" class="form-control" placeholder="Tanggal Buka" value="{{ $data->tanggal_buka }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">ID Staff</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="staff" readonly="" class="form-control" placeholder="ID Staff" value="{{ $data->id_anak }}" required>
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