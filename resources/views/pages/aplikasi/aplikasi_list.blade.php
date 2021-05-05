@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'aplikasi'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Aplikasi List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Nama Aplikasi
                                    </th>
                                    <th>
                                        Link
                                    </th>
                                    <th>
                                        Company
                                    </th>
                                </thead>
                                <tbody>
                                @foreach($index_data as $data)
                                    <tr>
                                        <td>{{ $data->id_apps }}</td>
                                        <td>{{ $data->nama_apps }}</td>
                                        <td>{{ $data->link_apps }}</td>
                                        <td>{{ $data->companies->nama_company }}</td>
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