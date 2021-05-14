@extends('components.table-view.table-view')
@section('table-body')
    <tbody>
        @foreach($index_data as $data)
            <tr>
                <td>{{ $data->id_divisi }}</td>
                <td>{{ $data->nama_divisi }}</td>
                <td>{{ $data->apps->nama_apps }}</td>
                <td class="table-view--body__edit-delete">@include('components.action-button.edit-delete', ['page' => $page, 'id' => $data->id_divisi])</td>
            </tr>
        @endforeach
    </tbody>
@endsection
