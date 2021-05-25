<form action="{{ route('page.import', $page) }}" method="POST" enctype="multipart/form-data">
    <div class="row">
        @csrf
        <div class="col-md-5">
            <input type="file" class="form-control input--file__excel" name="file" class="form-control" required>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-import">Import</button>
        </div>
        <div class="col-md-2">
            <a href="{{ asset('excel_template') }}/{{ $page }}_template.xlsx" class="btn btn-template">Template</a>
        </div>
        <div class="col-md-1">
            <a href="{{ route('page.export', [$page, 'page']). '?'. http_build_query(request()->all()) }}" class="btn btn-download">Export</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('page.export', [$page, 'all']). '?'. http_build_query(request()->all()) }}" class="btn btn-download">Export All</a>
        </div>
    </div>
</form>