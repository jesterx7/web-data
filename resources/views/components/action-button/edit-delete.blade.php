<div class="edit-delete--container">
    <div class="edit-delete--item">
        <form method="post" action="{{ route('api.delete', [$page, $id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-info btn-fill btn-action--delete">
                <i class="nc-icon nc-scissors"></i>
            </button>
        </form>
    </div>
    <div class="edit-delete--item">
        <form method="post" action="{{ route('api.delete', [$page, $id]) }}">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-info btn-fill btn-action--edit">
                <i class="nc-icon nc-share-66"></i>
            </button>
        </form>
    </div>
</div>