@extends('components.table-view.table-view')
@section('table-body')
    <tbody>
        @foreach($index_data as $data)
            <tr>
                <td>{{ $data->id_leader }}</td>
                <td>{{ $data->username }}</td>
                <td>{{ $data->password }}</td>
                <td>{{ $data->apps->nama_apps }}</td>
                <td class="table-view--body__edit-delete">@include('components.action-button.edit-delete', ['page' => $page, 'id' => $data->id_leader])</td>
            </tr>
        @endforeach
    </tbody>
@endsection
