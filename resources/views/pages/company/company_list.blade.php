@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'company'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Company List</h4>
                        <a class="btn btn-info btn-fill btn-wd add-table" href="{{ route('page.add', 'company') }}">
                                Add
                            </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Nama Company
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($index_data as $data)
                                        <tr>
                                            <td>{{ $data->id_company }}</td>
                                            <td>{{ $data->nama_company }}</td>
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