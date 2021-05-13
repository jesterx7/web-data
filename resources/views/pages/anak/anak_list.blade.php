@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'anak',
    'subtab' => 'Anak'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Anak</h4>
                            <div class="row">
                                <div class="col-md-2">
                                    <a class="btn btn-info btn-fill add-table add--data" href="{{ route('page.add', 'anak') }}">
                                    Add
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group select--search">
                                        <select name="anak" class="form-control">
                                        @foreach($filters as $key => $filter)
                                            <option class="filter--option" value="{{ $key }}">{{ $filter }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            <div class="col-md-2">
                                <div class="form-group select--search">
                                    <input type="text" name="search_anak" class="form-control" placeholder="Search" required>
                                </div>
                            </div>
                                <div class="col-md-1">
                                    <a class="btn btn-info btn-fill add-table" href="{{ route('page.add', 'anak') }}"><i class="nc-icon nc-zoom-split"></i>
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
                                        @sortablelink('id_anak', 'ID')
                                    </th>
                                    <th>
                                        @sortablelink('username', 'Username')
                                    </th>
                                    <th>
                                        @sortablelink('password', 'Password')
                                    </th>
                                    <th>
                                        @sortablelink('divisi.nama_divisi', 'Divisi')
                                    </th>
                                    <th>
                                        @sortablelink('leaders.username', 'Leader')
                                    </th>
                                    <th class="table-view--head__edit-delete">
                                        Edit / Delete
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </thead>
                                <tbody>
                                @foreach($index_data as $data)
                                    <tr>
                                        <td>{{ $data->id_anak }}</td>
                                        <td>{{ $data->username }}</td>
                                        <td>{{ $data->password }}</td>
                                        <td>{{ $data->divisi->nama_divisi }}</td>
                                        <td>{{ $data->leaders->username }}</td>
                                        <td class="table-view--body__edit-delete">@include('components.action-button.edit-delete', ['page' => $page, 'id' => $data->id_anak])</td>
                                        @if ($data->tutupbuka->last())
                                            @if ($data->tutupbuka->last()->tanggal_buka != '9999-12-31 00:00:00')
                                            <td>
                                                <form method="post" action="{{ route('api.tutupbuka', ['anak', $data->id_anak]) }}">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="text" name="action" value="tutup" hidden="true"/>
                                                    <button type="submit" class="btn btn-info btn-fill btn-action--close">
                                                        <i class="nc-icon nc-simple-remove"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            @else
                                            <td>
                                                <form method="post" action="{{ route('api.tutupbuka', ['anak', $data->id_anak]) }}">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="text" name="action" value="buka" hidden="true"/>
                                                    <button type="submit" class="btn btn-info btn-fill btn-action--open">
                                                        <i class="nc-icon nc-check-2"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            @endif
                                            @else
                                            <td>
                                                <form method="post" action="{{ route('api.tutupbuka', ['anak', $data->id_anak]) }}">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="text" name="action" value="tutup" hidden="true"/>
                                                    <button type="submit" class="btn btn-info btn-fill btn-action--close">
                                                        <i class="nc-icon nc-simple-remove"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $index_data->links() }}
                            <form action="{{ route('page.import', 'anak') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-6">
                                        <input type="file" class="form-control input--file__excel" name="file" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-export">Import Excel</button>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ asset('excel_template') }}/anak_template.xlsx" class="btn">Download Template</a>
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