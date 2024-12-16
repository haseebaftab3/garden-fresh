<div class="alert alert-{{ $type }} alert-border-left alert-dismissible fade show" role="alert">
    <i class="ri-{{ $icon }} me-3 align-middle"></i> {!! session('error_message') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
