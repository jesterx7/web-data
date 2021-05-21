@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'anak'
])

@section('content')
    <div class="content">
        <form class="col-md-12" action="{{ route('page.save', 'anak') }}" method="POST">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-header">
                    @include('layouts.errors_templates.errors_data')
                    <h5 class="title">Add Anak</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-md-3 col-form-label">Username</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Password</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="password" class="form-control" placeholder="Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">Tanggal Buka</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="datetime" name="open_date" class="form-control" placeholder="Open Date" value="{{ $open }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row row--apps">
                        <label class="col-md-3 col-form-label">Apps</label>
                        <div class="col-md-9">
                            <div class="form-group">
                            <select id="select--apps" name="apps" class="form-control">
                                <option value="0"></option>
                                @foreach($apps as $app)
                                    <option value="{{ $app->id_apps }}">{{ $app->nama_apps }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info btn-round">Add Anak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#select--apps").change(function() {
                var id = this.value;
                var urlLeader = '{{ route('api.ajax', ['leader', ':id', 0]) }}';
                var urlDivisi = '{{ route('api.ajax', ['divisi', ':id', 0]) }}';
                $.when(
                    $.ajax({
                        url: urlLeader.replace(':id', id),
                        type: 'GET',
                        success: function(response) {
                            if ($('.row--leader').length > 0) {
                                $('.row--leader').remove();
                            }
                            $(".row--apps").after(response);
                        }
                    }),
                    $.ajax({
                        url: urlDivisi.replace(':id', id),
                        type: 'GET',
                        success: function(response) {
                            if ($('.row--divisi').length > 0) {
                                $('.row--divisi').remove();
                            }
                            $(".row--leader").after(response);
                        }
                    })
                );
            });
        });
    </script>
@endpush