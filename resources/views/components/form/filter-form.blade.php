<div class="row">
    <div class="col-md-2">
        <a class="btn btn-info btn-fill add-table add--data" href="{{ route('page.add', $page) }}">
        Add
        </a>
    </div>
    <div class="col-md-3">
        <div class="form-group select--search">
            <select name="option" class="form-control">
            @foreach($filters as $key => $filter)
                <option class="filter--option" value="{{ $key }}">{{ $filter }}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group select--search">
            <input type="text" name="search" class="form-control" placeholder="Search" required>
        </div>
    </div>
    <div class="col-md-1">
        <a class="btn btn-info btn-fill add-table" href="{{ route('page.add', $page) }}"><i class="nc-icon nc-zoom-split"></i>
        </a>
    </div>
</div>