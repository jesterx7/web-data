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
                        <div class="row">
                            <div class="col-md-2">
                                <a class="btn btn-info btn-fill add-table add--data" href="{{ route('page.add', 'aplikasi') }}">
                                Add
                                </a>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group select--search">
                                    <select name="aplikasi" class="form-control">
                                    </select>
                                </div>
                            </div>
                        <div class="col-md-2">
                            <div class="form-group select--search">
                                <input type="text" name="search_aplikasi" class="form-control" placeholder="Search" required>
                            </div>
                        </div>
                            <div class="col-md-1">
                                <a class="btn btn-info btn-fill add-table" href="{{ route('page.add', 'aplikasi') }}"><i class="nc-icon nc-zoom-split"></i>
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
                            <form action="{{ route('page.import', 'aplikasi') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-6">
                                        <input type="file" class="form-control input--file__excel" name="file" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-export">Import Excel</button>
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