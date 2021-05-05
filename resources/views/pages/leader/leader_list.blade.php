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
                        <h4 class="card-title">Anak List</h4>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection