@extends('components.table-view.table-view')
@section('table-body')
    <tbody>
        @foreach($index_data as $data)
            <tr>
                <td>{{ $data->id_tutupbuka }}</td>
                <td>{{ $data->anak->username }}</td>
                <td>{{ $data->anak->apps->nama_apps }}</td>
                <td>{{ $data->tanggal_tutup }}</td>
                <td>{{ $data->tanggal_buka }}</td>
                <td class="table-view--body__edit-delete">@include('components.action-button.edit-delete', ['page' => $page, 'id' => $data->id_tutupbuka])</td>
            </tr>
        @endforeach
    </tbody>
@endsection