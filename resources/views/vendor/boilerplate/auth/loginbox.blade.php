<div class="login-box main-box-right-padding">
    <div class="login-logo">
        {{-- {!! config('boilerplate.theme.sidebar.brand.logo.icon') ?? '' !!}
        {!! config('boilerplate.theme.sidebar.brand.logo.text') ?? $title ?? '' !!} --}}
        {{-- <img src="{{ asset('assets/vendor/boilerplate/images/vendor/eva_logo_temp.png') }}" style="max-width:250px;"> --}}
        <div class="row">
            <div class="col-sm-9 text-left">
                <h2><strong>Welcome back!</strong></h2>
                {{-- <h4><strong>Access your AI Chatbot</strong></h4> --}}
            </div>
            <div class="col-sm-3">
                <button class="btn btn-primary" type="button">Register</button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            {{ $slot }}
        </div>
    </div>
</div>
