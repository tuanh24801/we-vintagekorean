@if (session('message'))
    <h2 class="alert alert-success">{{ session('message') }}</h2>
@else
    <h2>Bạn không phải admin</h2>
@endif
