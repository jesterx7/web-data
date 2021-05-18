@extends('components.table-view.table-view')
@section('table-body')
    <tbody>
        @foreach($index_data as $data)
            <tr>
                <td>{{ $data->id_anak }}</td>
                <td>{{ $data->username }}</td>
                <td>{{ $data->password }}</td>
                <td>{{ $data->divisi->nama_divisi }}</td>
                <td>{{ $data->apps->nama_apps }}</td>
                @if ($data->tutupbuka->last())
                    @if ($data->tutupbuka->last()->tanggal_buka != '9999-12-31 00:00:00')
                        <td>OPEN</td>
                    @else
                        <td>CLOSED</td>
                    @endif
                @else
                    <td>OPEN</td>
                @endif
                @if (Auth::user()->isAdmin())
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
                @endif
                <td class="table-view--body__edit-delete">@include('components.action-button.edit-delete', ['page' => $page, 'id' => $data->id_anak])</td>
            </tr>
        @endforeach
    </tbody>
@endsection