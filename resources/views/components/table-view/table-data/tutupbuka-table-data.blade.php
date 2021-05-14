@extends('components.table-view.table-view')
@section('table-body')
    <tbody>
        @foreach($index_data as $data)
            <tr>
                <td>{{ $data->id_tutupbuka }}</td>
                <td>{{ $data->anak->username }}</td>
                <td>{{ $data->tanggal_tutup }}</td>
                <td>{{ $data->tanggal_buka }}</td>
            </tr>
        @endforeach
    </tbody>
@endsection