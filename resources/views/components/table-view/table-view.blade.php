<div class="table-responsive">
    @include('layouts.errors_templates.errors_data')
    <table class="table">
        <thead class=" text-primary">
            @foreach ($table_head as $key => $head)
                @if ($key == 'del_edit')
                    @if (Auth::user()->isAdmin())
                        <th class="table-view--head__edit-delete">
                            {{ $head }}
                        </th>
                    @endif
                @elseif ($key == 'action')
                    @if (Auth::user()->isAdmin())
                        <th>
                            {{ $head }}
                        </th>
                    @endif
                @else
                    <th>
                        @sortablelink($key, $head)
                    </th>
                @endif
            @endforeach
            </th>
        </thead>
        @yield('table-body')
    </table>
    {{ $index_data->appends(Request::only('option', 'search'))->links() }}
    
    @if ($page != 'dashboard' && Auth::user()->isAdmin())
        @include('components.form.import_export-form')
    @endif
</div>