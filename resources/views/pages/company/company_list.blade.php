@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'company',
    'subtab' => 'Company'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Company</h4>
                        <div class="row">
                            <div class="col-md-2">
                                <a class="btn btn-info btn-fill add-table add--data" href="{{ route('page.add', 'company') }}">
                                Add
                                </a>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group select--search">
                                    <select name="company" class="form-control">
                                    @foreach($filters as $key => $filter)
                                        <option class="filter--option" value="{{ $key }}">{{ $filter }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group select--search">
                                    <input type="text" name="search_company" class="form-control" placeholder="Search" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <a class="btn btn-info btn-fill add-table" href="{{ route('page.add', 'company') }}"><i class="nc-icon nc-zoom-split"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @include('layouts.errors_templates.errors_data')
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        @sortablelink('id_company', 'ID')
                                    </th>
                                    <th>
                                        @sortablelink('nama_company', 'Company')
                                    </th>
                                    <th class="table-view--head__edit-delete">
                                        Edit / Delete
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($index_data as $data)
                                        <tr>
                                            <td>{{ $data->id_company }}</td>
                                            <td>{{ $data->nama_company }}</td>
                                            <td class="table-view--body__edit-delete">@include('components.action-button.edit-delete', ['page' => $page, 'id' => $data->id_company])</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $index_data->links() }}
                            <form action="{{ route('page.import', 'company') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-6">
                                        <input type="file" class="form-control input--file__excel" name="file" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-export">Import Excel</button>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ asset('excel_template') }}/company_template.xlsx" class="btn">Download Template</a>
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