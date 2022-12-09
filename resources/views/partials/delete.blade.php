<form id="delete-form" action="" method="POST" data-message="{{ __('Are you sure you want to delete this item?') }}">
    @method('DELETE')
    @csrf
</form>