@extends('components.table-view.table-view')
@section('table-body')
    <tbody>
        @foreach($index_data as $data)
            <tr>
                <td>{{ $data->id_apps }}</td>
                <td>{{ $data->nama_apps }}</td>
                <td>{{ $data->link_apps }}</td>
                <td>{{ $data->companies->nama_company }}</td>
                <td class="table-view--body__edit-delete">@include('components.action-button.edit-delete', ['page' => $page, 'id' => $data->id_apps])</td>
            </tr>
        @endforeach
    </tbody>
@endsection