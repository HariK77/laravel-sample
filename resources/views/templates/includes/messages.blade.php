@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-error alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('resent'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ __('A fresh verification link has been sent to your email address.') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div id="success-message"></div>
<div id="error-message"></div>
