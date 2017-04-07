@if (count($errors) > 0)
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Please fix these errors and try again!</h4>
    <ul>
      <li>{{ session('errors') }}</li>
    </ul>
</div>
@endif
