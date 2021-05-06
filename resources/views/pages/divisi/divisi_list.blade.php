@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'divisi'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Divisi List</h4>
                        <div class="row">
                            <div class="col-md-2">
                                <a class="btn btn-info btn-fill add-table add--data" href="{{ route('page.add', 'divisi') }}">
                                Add
                                </a>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group select--search">
                                    <select name="divisi" class="form-control">
                                    </select>
                                </div>
                            </div>
                        <div class="col-md-2">
                            <div class="form-group select--search">
                                <input type="text" name="search_divisi" class="form-control" placeholder="Search" required>
                            </div>
                        </div>
                            <div class="col-md-1">
                                <a class="btn btn-info btn-fill add-table" href="{{ route('page.add', 'divisi') }}"><i class="nc-icon nc-zoom-split"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Nama Divisi
                                    </th>
                                    <th>
                                        Nama Apps
                                    </th>
                                </thead>
                                <tbody>
                                @foreach($index_data as $data)
                                    <tr>
                                        <td>{{ $data->id_divisi }}</td>
                                        <td>{{ $data->nama_divisi }}</td>
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