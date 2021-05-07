@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'leader'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Leader List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Username
                                    </th>
                                    <th>
                                        Password
                                    </th>
                                    <th>
                                        Apps
                                    </th>
                                    <th>
                                </thead>
                                <tbody>
                                @foreach($index_data as $data)
                                    <tr>
                                        <td>{{ $data->id_leader }}</td>
                                        <td>{{ $data->username }}</td>
                                        <td>{{ $data->password }}</td>
                                        <td>{{ $data->apps->nama_apps }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <form action="{{ route('page.import', 'leader') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-6">
                                        <input type="file" class="form-control input--file__excel" name="file" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-export">Import Excel</button>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ asset('excel_template') }}/leader_template.xlsx" class="btn">Download Template</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection