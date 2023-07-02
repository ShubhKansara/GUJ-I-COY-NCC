@extends('boilerplate::auth.layout', [
    'title' => __('boilerplate::auth.login.title'),
    'bodyClass' => 'hold-transition login-page'
])

@section('content')
<style>
    .login-page{background: white;}
    .card{box-shadow: unset;}
    .card .card-body{padding: 0;}
    .main-box-right-padding{padding-right:50px;}
    .main-box-left-padding{padding-left:50px;}
    .d-inline-table{
        display: inline-table;
    }
    .v-center {
        height: 100vh;
        display: flex;
        align-items: center;
        padding: 35px;
        justify-content: center;
        width: 100%;
    }
    .login-box, .register-box{
        width: 85%;
        max-width: 500px;
        display: inline-table;
        text-align: left;
    }
    label:not(.form-check-label):not(.custom-file-label){margin-bottom: 8px;}
    @media(min-width: 1200px){
        .v-center{
            width: 100%;
        }
    }
    @media only screen and (min-device-width: 786px) and (max-device-width: 1200px) {
        .chatbot_iframe{
            width: 400px;
        }
    }
    @media(max-width: 786px){
        .login-box, .register-box{width: 100%!important;display:inline-table;text-align: left;}
        .v-center{padding: 30px;}
        .v-center .col-md-6:first-child{text-align: center;}
        .login-box .col-sm-9{flex: 0 0 75%;max-width: 75%}
        .login-box .col-sm-3{flex: 0 0 25%;max-width: 25%}
        .main-box-left-padding{padding-left: 0px;}
        .main-box-right-padding{padding-right: 0px;}
        .chatbot_iframe{
            width: 100%;
            margin-top: 50px;
        }
    }
</style>

<div class="row v-center">
    <div class="col-md-6 justify-content-center d-inline-table text-right">
        @component('boilerplate::auth.loginbox')
            <p class="login-box-msg text-sm">@lang('boilerplate::auth.fields.intro_set_password')</p>
            <input type="hidden" value="{{ $token }}" name="invite_token">
            {!! Form::open(['route' => 'userInvitePasswordSet', 'method' => 'post', 'autocomplete'=> 'off', 'class' => 'mt-3']) !!}
            @component('boilerplate::input', ['value' => $token, 'name' => 'invite_token', 'type' => 'hidden'])@endcomponent
            @component('boilerplate::password', ['label' => 'Password', 'name' => 'password', 'placeholder' => 'boilerplate::auth.fields.password'])@endcomponent
            @component('boilerplate::password', ['label' => 'Password Confirmation', 'name' => 'password_confirmation', 'placeholder' => 'boilerplate::auth.fields.password_confirm', 'check' => false])@endcomponent

            <div class="d-flex flex-wrap align-items-center justify-content-between">
                {{-- @component('boilerplate::icheck', ['name' => 'remember', 'checked' => old('remember') == 'on', 'label' => 'boilerplate::auth.login.rememberme', 'class' => 'text-sm'])@endcomponent --}}
                <button type="submit" class="btn btn-primary btn-block mb-3 mt-4">@lang('boilerplate::auth.fields.set_password')</button>
            </div>
            {!! Form::close() !!}
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    {{-- <p class="mb-1 text-sm">
                        <a href="{{ route('boilerplate.password.request') }}">@lang('boilerplate::auth.login.forgotpassword')</a><br>
                    </p> --}}
                    <p class="mb-1 text-sm">
                        <a href="{{ route('boilerplate.login') }}">@lang('boilerplate::auth.password.login_link')</a>
                    </p>
                    @if(config('boilerplate.auth.register'))
                        <p class="mb-0 text-sm">
                            <a href="{{ route('boilerplate.register') }}" class="text-center">@lang('boilerplate::auth.login.register')</a>
                        </p>
                    @endif
                </div>
                @if(config('boilerplate.locale.switch', false))
                <div class="dropdown-wrapper">
                    <div class="form-group">
                        <select class="form-control form-control-sm" onchange="if (this.value) window.location.href=this.value">
                            @foreach(collect(config('boilerplate.locale.languages'))->map(function($e){return $e['label'];})->toArray() as $lang => $label)
                                <option value="{{ route('boilerplate.lang.switch', $lang) }}" {{ $lang === App::getLocale() ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
            </div>
        @endcomponent
    </div>
    <div class="col-md-6 justify-content-center d-inline-table">
        <div class="d-inline-table text-left main-box-left-padding">
            <iframe class="chatbot_iframe" src='https://eva.extrahourz.com/widget/landing%20page' height='550px' width='500px' frameborder=0></iframe>
        </div>
    </div>
</div>
@endsection
