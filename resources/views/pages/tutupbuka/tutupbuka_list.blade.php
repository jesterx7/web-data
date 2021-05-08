@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'tutupbuka'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">TutupBuka List</h4>
                            <div class="row">
                                <div class="col-md-2">
                                    <a class="btn btn-info btn-fill add-table add--data" href="{{ route('page.add', 'tutupbuka') }}">
                                    Add
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group select--search">
                                        <select name="tutupbuka" class="form-control">
                                        </select>
                                    </div>
                                </div>
                            <div class="col-md-2">
                                <div class="form-group select--search">
                                    <input type="text" name="search_tutupbuka" class="form-control" placeholder="Search" required>
                                </div>
                            </div>
                                <div class="col-md-1">
                                    <a class="btn btn-info btn-fill add-table" href="{{ route('page.add', 'tutupbuka') }}"><i class="nc-icon nc-zoom-split"></i>
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
                                        tutupbuka
                                    </th>
                                    <th>
                                        Tanggal Tutup
                                    </th>
                                    <th>
                                        Tanggal Buka
                                    </th>
                                    <th>
                                </thead>
                                <tbody>
                                @foreach($index_data as $data)
                                    <tr>
                                        <td>{{ $data->id_tutupbuka }}</td>
                                        <td>{{ $data->tutupbuka->username }}</td>
                                        <td>{{ $data->tanggal_tutup }}</td>
                                        <td>{{ $data->tanggal_buka }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $index_data->links() }}
                            <form action="{{ route('page.import', 'tutupbuka') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-6">
                                        <input type="file" class="form-control input--file__excel" name="file" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-export">Import Excel</button>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ asset('excel_template') }}/tutupbuka_template.xlsx" class="btn">Download Template</a>
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