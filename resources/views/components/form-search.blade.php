@props(['name'])

<form method="get" class="form-inline">
  <div class="input-group input-group-sm ml-auto">
    <input type="text" name="{{ $name }}" value="<?= request()->input($name) ?>" placeholder="Search..." class="form-control">
    <div class="input-group-append">
      <button class="btn btn-outline-secondary">
        <i class="fas fa-search"></i>
      </button>
    </div>
  </div>
</form>