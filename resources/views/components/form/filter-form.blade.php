
<div class="row">
    @if (Auth::user()->isAdmin() && $page != 'tutupbuka')
        <div class="col-md-2">
            <a class="btn btn-info btn-fill add-table add--data" href="{{ route('page.add', $page) }}">
            Add
            </a>
        </div>
    @endif
    <form class="col-md-10" action="{{ route('page.search', $page) }}" method="get" role="search">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group select--search">
                    <select name="option" class="form-control">
                    @foreach($filters as $key => $filter)
                        <option class="filter--option" value="{{ $filter['relation_name'] }}:{{ $key }}">{{ $filter['name'] }}</option>
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
                <button type="submit" class="btn btn-info btn-fill add-table"><i class="nc-icon nc-zoom-split"></i></button>
            </div>
        </div>
    </form>
</div>