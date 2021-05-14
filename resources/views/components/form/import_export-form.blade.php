<form action="{{ route('page.import', $page) }}" method="POST" enctype="multipart/form-data">
    <div class="row">
        @csrf
        <div class="col-md-6">
            <input type="file" class="form-control input--file__excel" name="file" class="form-control" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-export">Import Excel</button>
        </div>
        <div class="col-md-3">
            <a href="{{ asset('excel_template') }}/{{ $page }}_template.xlsx" class="btn">Download Template</a>
        </div>
    </div>
</form>