@extends('components.table-view.table-view')
@section('table-body')
    <tbody>
        @foreach($index_data as $data)
            <tr>
                <td>{{ $data->id_tutupbuka }}</td>
                <td>{{ $data->anak->username }}</td>
                <td>{{ $data->anak->apps->nama_apps }}</td>
                @if ($data->tanggal_tutup == '9999-12-31 00:00:00')
                    <td>-</td>
                @else
                    <td>{{ $data->tanggal_tutup }}</td>
                @endif
                @if ($data->tanggal_buka == '9999-12-31 00:00:00')
                    <td>-</td>
                @else
                    <td>{{ $data->tanggal_buka }}</td>
                @endif
                <td class="table-view--body__edit-delete">@include('components.action-button.edit-delete', ['page' => $page, 'id' => $data->id_tutupbuka])</td>
            </tr>
        @endforeach
    </tbody>
@endsection